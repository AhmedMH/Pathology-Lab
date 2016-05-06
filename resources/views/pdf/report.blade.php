<!-- View to be rendered as PDF -->
<!DOCTYPE html>
<html>
<head>
	<title>Report - $report->name</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<h2>Report Details:</h2>
	<hr>

	<table width="100%" >
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>patient Name</th>
			<th>Created At</th>
			<th>Operator Name</th>
		</tr>
	</thead>
	<tbody>
		<tr align="center">
			<td>{{ $report->id }}</td>
			<td>{{ $report->name }}</td>
			<td>{{ $report->patient->name }}</td>
			<td>{{ $report->created_at->format('d M Y - g:i A') }}</td>
			<td>{{$report->operator->name}}</td>
		</tr>
	</tbody>
</table>
<br/><br/>

<h2>Test Results:</h2>
<hr>
<table border="1" width="100%" >
	<thead> 
		<tr class="info"> 
			<th>Test Name</th> 
			<th>Test Result</th>
		</tr> 
	</thead>
	
	@forelse ($tests as $test)
	<tr align="center">
		<td>{{$test->name}}</td>
		<td>{{$test->result}}</td>
	</tr>
	@empty
	<br>
	<h1 style="text-align:center;">No tests yet in this report!</h1>
	@endforelse
</table>

</body>
</html>





