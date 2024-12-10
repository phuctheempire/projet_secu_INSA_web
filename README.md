## Construction du site web actuel

![image](https://github.com/user-attachments/assets/39a81782-5b44-4362-bf76-9f94a6ffd960)


## Schema monitoring & relation AMP et systeme

![image](https://github.com/user-attachments/assets/30589299-a20f-47a6-a241-ccd557e49b10)

## To do list (web)

![image](https://github.com/user-attachments/assets/e89944ca-a136-46db-99ee-7b0ce0409aa6)

### SQL User
```sql
CREATE USER `user2`@`%` IDENTIFIED VIA mysql_native_password USING '*34D3B87A652E7F0D1D371C3DBF28E291705468C4';

GRANT USAGE ON *.* TO `user2`@`%` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

GRANT SELECT, INSERT, UPDATE, DELETE ON `insa_db`.`Posts` TO `user2`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `insa_db`.`Cours_info` TO `user2`@`%`;

GRANT SELECT, INSERT, UPDATE, DELETE ON `insa_db`.`Users` TO `user2`@`%`;
```