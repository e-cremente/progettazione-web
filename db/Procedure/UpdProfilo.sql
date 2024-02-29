USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.UpdProfilo;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdProfilo`(
pUser varchar(32) ,
pNewEmail varchar(128),
pNewPwd longtext
)
UpdProfilo: BEGIN

        UPDATE utenti
           SET Email = pNewEmail,
                     Password = coalesce(pNewPwd, Password)
         WHERE Username = pUser;
 
end
//