<?php

namespace App\Model;

use Dibi\Connection;
use Dibi\Row;

final class ContactRepository
{
    public function __construct(
        private readonly Connection $connection,
    )
    {
    }

    public function find(
        ?int $id = null,
        ?string $query = null,
    ): array|Row|null
    {
        $phones = $this->connection
            ->select('contact_id')
            ->select('GROUP_CONCAT(number SEPARATOR "|") AS phones')
            ->from('phone')
            ->groupBy('contact_id');

        $select = $this->connection
            ->select('[contact].*')
            ->select('[TP].[phones]')
            ->from('contact')
            ->leftJoin($phones, 'TP')
            ->on('[contact].id = TP.contact_id');

        if ($id) {
            return $select
                ->where('id = %i', $id)
                ->fetch();
        }

        if ($query) {

            $cond = [];

            foreach (['firstname', 'lastname', 'company', 'email', 'phones'] as $column) {
                $cond[] = ["%n LIKE %~like~", $column, $query];
            }

            $select->where('(%or)', $cond);
        }

        $select
            ->orderBy('firstname')
            ->orderBy('lastname');

        return $select->fetchAll();
    }

    public function create(
        array $data,
    ): Row|null
    {
        $this->connection->insert('contact', $this->filterData($data))->execute();

        $id = $this->connection->getInsertId();

        // ulozeni telefonnich cisel
        $this->setPhones($id, $data['phones'] ?? []);

        return $this->find($id);
    }

    public function update(
        int $id,
        array $data,
    ): Row|null
    {
        $this->connection->update('contact', $this->filterData($data))
            ->where('id = %i', $id)
            ->execute();

        // ulozeni telefonnich cisel
        if (key_exists('phones', $data)) {
            $this->setPhones($id, $data['phones']);
        }

        return $this->find($id);
    }


    private function filterData(array $data): array
    {
        $blacklist = [
            'id',
            'phones',
        ];

        return array_filter($data, fn($key): bool => !in_array($key, $blacklist), ARRAY_FILTER_USE_KEY);
    }

    private function setPhones(int $contactId, array $phones): void
    {
        $bind = [];

        foreach (array_filter($phones) as $value) {
            $bind['contact_id'][] = $contactId;
            $bind['number'][] = $value;
        }

        if ($bind) {
            $this->connection->query('INSERT IGNORE INTO [phone] %m', $bind);
        }

        $delete = $this->connection
            ->delete('phone')
            ->where('contact_id = ?', $contactId);
        if ($phones) {
            $delete->where('number NOT IN %in', $phones);
        }
        $delete->execute();
    }

    public function delete(
        int $id,
    ): bool
    {
        $row = $this->find($id);

        if (!$row) {
            return false;
        }

        $this->connection->delete('contact')
            ->where('id = %i', $id)
            ->execute();

        return true;
    }
}
