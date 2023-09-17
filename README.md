point of sale system


CHANGES MADE TO THE DATABASE

[POS].[V_ProductRetail_InventoryR] -> Added RetailPrice column
[CodeMaster].[PaymentMethod] -> Added A new record for both Cash and Card payments -> RecID = 5
[GlobalSetup].[POSInvoiceStatus] -> Created this to track invoice hold status and added records to it 
[GlobalSetup].[ProductSource] -> created this to store product sources and added to records to it [{RecID: 1, Name: "Warehouse"}, {RecID: 2, Name: "Showroom"}]
[POS].[InvoiceDetailTemporary] -> Added column to track the source of the products (warehouse or showroom) -> ProductSourceRecID (defaults to 1)
[POS].[InvoiceDetail] -> Added column to track the source of the products (warehouse or showroom) -> ProductSourceRecID (defaults to 1)
[POS].[V_InvoiceDetailTemporary] -> Added a new column [ProductSourceRecID]
[POS].[V_InvoiceDetail] -> Added a new column [ProductSourceRecID]