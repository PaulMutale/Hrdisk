<!DOCTYPE html>
<html>
<head>
    <!--Datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
 <!--Ends datatables-->   
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
<center>
<h1>{{Auth::user()->username}}</h1>
<h3>Employees List</h3>


</center>
<table id="customers">
  <tr>
    <th>Names</th>
    <th>Email</th>
    <th>Phone</th>
    <th>TPIN</th>
    <th>Gender </th>
    <th>Salary</th>
    <th>Address</th>
    <th>Birthdate</th>
    <th>EmployeeID</th>
  </tr>
  @foreach ($employees as $employee)
  <tr>
    
    <td>{{$employee->first_name}} {{$employee->last_name}}</td>
    <td>{{$employee->email}}</td>
    <td>{{$employee->phone}}</td>
    <td>{{$employee->tpin}}</td>
    <td>{{$employee->gender}}</td>
    <td>{{$employee->salary}}</td>
    <td>{{$employee->address}}</td>
    <td>{{$employee->birthdate}}</td>
    <td>{{$employee->employee_id}}</td>
   
  </tr>
  @endforeach
</table>




<script>
$(document).ready(function () {
    $('#customers').DataTable();
});
</script>
</body>
</html>
