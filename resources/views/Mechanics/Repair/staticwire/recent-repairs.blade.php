<table id="example2" class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Vehicle</th>
        <th>Materials Used</th>
        <th>Base Cost</th>
        <th>Timestamp</th>
    </tr>
    </thead>
    <tbody>
    @foreach($latest as $repair)
        <tr>
            <td>{{$repair->id}}</td>
            <td>{{$repair->customer_name}}</td>
            <td>{{$repair->vehicle}}</td>
            <td>SC: {{$repair->scrap_used}} · AL: {{$repair->alum_used}} · ST: {{$repair->steel_used}} · GL: {{$repair->glass_used}} · RB: {{$repair->rubber_used}} · AK: {{$repair->advKit}} · O:{{$repair->oil}}</td>
            <td>${{$repair->cost}}</td>
            <td>{{$repair->timestamp}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
