var connection = new ActiveXObject("ADODB.Connection") ;

var connectionstring="driver={sql server};server=KEVIN-JORN-PC;database=saudipos;";

connection.Open(connectionstring);
var rs = new ActiveXObject("ADODB.Recordset");

rs.Open("SELECT * FROM Inventory.Product", connection);
rs.MoveFirst()
while(!rs.EOF)
{
   document.write(rs.fields(1));
   console.log(rs.fields(1));
   rs.movenext;
}

rs.close;
connection.close; 