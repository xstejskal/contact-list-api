Contact List API
=================
GraphQL API je vytvořeno z [Nette Web Project](https://github.com/nette/web-project).

Aplikace obsahuje jednoduchý databázový model nad knihovnou [dibi](https://dibiphp.com/). 

Pro implementaci GraphQL serveru je použita knihovna [graphpinator](https://github.com/graphpql/graphpinator).

Požadavky
------------
https://github.com/nette/web-project?tab=readme-ov-file#requirements


Instalace
------------
Po naklonování repozitáře je potřeba nainstalovat závislosti pomocí Composeru.

    composer install

Ujistěte se, že do adresářů `temp/` a `log/` lze zapisovat.

SQL dump pro vytvoření databáze (použitá MariaDB) je v souboru `db/schema.sql`

V souboru `config/common.neon` je potřeba nastavit údaje pro připojení k databázi.

Nastavení Web Serveru
----------------
https://github.com/nette/web-project?tab=readme-ov-file#web-server-setup

Použití
----------------
API endpoint je dostupný na adrese `http://<HOST>/`

Schéma je dostupné na adrese `http://<HOST>/schema.graphql`

Na adrese `http://<HOST>/docs/` je dostupná vygenerovaná dokumentace s ukázkami volání.

Na adrese `http://<HOST>/graphiql` je dostupné "hříště" pro testování dotazů na API.
