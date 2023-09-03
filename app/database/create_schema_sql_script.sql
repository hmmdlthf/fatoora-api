-- Create the Product Table (if it doesn't exist)
CREATE TABLE Product (
    ProductID INT PRIMARY KEY,
    Name VARCHAR(100),
    Description VARCHAR(255),
    Category VARCHAR(50),
    Price DECIMAL(10, 2),
    StockQuantity INT
);

-- Create the Inventory Table
CREATE TABLE Inventory (
    InventoryID INT PRIMARY KEY,
    ProductID INT FOREIGN KEY REFERENCES Product(ProductID),
    Quantity INT,
    LastRestockDate DATE,
    Supplier VARCHAR(255),
    CostPrice DECIMAL(10, 2),
    SellingPrice DECIMAL(10, 2)
);

-- Create the Customer Table
CREATE TABLE Customer (
    CustomerID INT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(100),
    Phone VARCHAR(20),
    Address VARCHAR(255)
);

-- Create the Sales Table (formerly Order Table)
CREATE TABLE Sales (
    SalesID INT PRIMARY KEY,
    CustomerID INT FOREIGN KEY REFERENCES Customer(CustomerID),
    SalesDate DATE,
    TotalAmount DECIMAL(10, 2)
);

-- Create the OrderItem Table
CREATE TABLE OrderItem (
    OrderItemID INT PRIMARY KEY,
    SalesID INT FOREIGN KEY REFERENCES Sales(SalesID),
    ProductID INT FOREIGN KEY REFERENCES Product(ProductID),
    Quantity INT,
    Subtotal DECIMAL(10, 2)
);


