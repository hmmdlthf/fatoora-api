CREATE TABLE Emtyaz.[Fatoora].[Invoice]
(
    [RecID] int IDENTITY(1,1) PRIMARY KEY,
    [InvoiceNumber] varchar(255),
    [InvoiceHash] varchar(255),
    [UUID] varchar(255),
    [QR] varchar(255),
    [Stamp] varchar(255),
    [PIH] varchar(255),
    [Invoice] nvarchar(max)
)

CREATE TABLE Emtyaz.[Fatoora].[POSInvoice]
(
    [RecID] int IDENTITY(1,1) PRIMARY KEY,
    [InvoiceNumber] varchar(255),
    [InvoiceHash] varchar(255),
    [UUID] varchar(255),
    [QR] varchar(255),
    [Stamp] varchar(255),
    [PIH] varchar(255),
    [Invoice] nvarchar(max)
)

CREATE TABLE Emtyaz.[Fatoora].[BusinessInvoice]
(
    [RecID] int IDENTITY(1,1) PRIMARY KEY,
    [InvoiceNumber] varchar(255),
    [InvoiceHash] varchar(255),
    [UUID] varchar(255),
    [QR] varchar(255),
    [Stamp] varchar(255),
    [PIH] varchar(255),
    [Invoice] nvarchar(max)
)

CREATE TABLE Emtyaz.Fatoora.CSIDTemp
(
    RecID INT IDENTITY(1,1) PRIMARY KEY,
    CSR NVARCHAR(MAX),
    Secret NVARCHAR(MAX),
    BinarySecurityToken NVARCHAR(MAX),
    CreatedDate DATETIME,
    ExpireDate DATETIME,
    RequestID BIGINT,
    CONSTRAINT UC_RequestID UNIQUE (RequestID)
);

CREATE TABLE Emtyaz.Fatoora.CSIDProduction
(
    RecID INT IDENTITY(1,1) PRIMARY KEY,
    CSR NVARCHAR(MAX),
    Secret NVARCHAR(MAX),
    BinarySecurityToken NVARCHAR(MAX),
    CreatedDate DATETIME,
    ExpireDate DATETIME,
    RequestID BIGINT,
    RequestedSecurityToken NVARCHAR(MAX),
    Status NVARCHAR(50),
    -- Adjust the size as needed
    CONSTRAINT UCP_RequestID UNIQUE (RequestID)
);

CREATE TABLE Emtyaz.Fatoora.CSIDStatus
(
    RecID INT IDENTITY(1,1) PRIMARY KEY,
    Code NVARCHAR(20) UNIQUE,
    Name NVARCHAR(50),
    Description NVARCHAR(MAX),
    CreatedDate DATETIME
);

INSERT INTO Emtyaz.Fatoora.CSIDStatus
    (Code, Name, Description, CreatedDate)
VALUES
    ('ACTIVE', 'Active', 'The item is currently active', GETDATE()),
    ('INACTIVE', 'Inactive', 'The item is currently inactive', GETDATE()),
    ('PENDING', 'Pending', 'The item is pending', GETDATE());