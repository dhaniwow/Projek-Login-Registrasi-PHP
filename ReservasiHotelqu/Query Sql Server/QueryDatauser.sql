CREATE DATABASE RESERVASILAPANGAN

USE RESERVASILAPANGAN

CREATE TABLE Penggunasistem (
    UserID VARCHAR(15) PRIMARY KEY,
    NamaLengkap NVARCHAR(100) NOT NULL,
    EmailUser NVARCHAR(100) NOT NULL,
    Telepon NVARCHAR(15) NOT NULL,
    PasswordUser VARCHAR(255),
    TglRegistrasi DATE DEFAULT GETDATE(),
    RoleUser NVARCHAR(20) CHECK (RoleUser IN ('Customer', 'Owner', 'Staff', 'Admin'))
);



GO

select * from Penggunasistem

GO
