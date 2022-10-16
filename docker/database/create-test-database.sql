DROP DATABASE IF EXISTS app_test;
DROP USER IF EXISTS app_test;

CREATE USER app_test WITH ENCRYPTED PASSWORD '!ChangeMe!';
CREATE DATABASE app_test WITH OWNER app_test;

GRANT CONNECT ON DATABASE app_test TO app_test;
GRANT pg_read_all_data TO app_test;
GRANT pg_write_all_data TO app_test;
