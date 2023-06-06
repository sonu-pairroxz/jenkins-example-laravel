<table>
    <thead>
        <tr>
            <th>Ticket ID</th>
            <th>User Name</th>
            <th>ASIN</th>
            <th>Product Name</th>
            <th>Error Type</th>
            <th>SIM</th>
            <th>Node</th>
            <th>Marketplace</th>
            <th>Correct Code</th>
            <th>Incorrect Code</th>
            <th>Keywords</th>
            <th>Learnings</th>
            <th>Correct Methodology</th>
            <th>Reference</th>
            <th>Date Added</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jitlearning as $q)
            <tr>
                <td>{{$q->ticket_id}}</td>
                <td>{{$q->user->first_name}}</td>
                <td>{{$q->asin}}</td>
                <td>{{$q->product_name}}</td>
                <td>{{$q->error_type}}</td>
                <td>{{$q->sim}}</td>
                <td>{{$q->node}}</td>
                <td>{{$q->marketplace}}</td>
                <td>{{$q->correct_code}}</td>
                <td>{{$q->incorrect_code}}</td>
                <td>{{$q->keywords}}</td>
                <td>{{$q->learnings}}</td>
                <td>{{$q->correct_methodology}}</td>
                <td>{{$q->reference}}</td>
                <td>{{ \Carbon\Carbon::parse($q->created_at)->format("d M, Y")}}</td>
            </tr>
        @empty
        <tr>
            <td colspan="17">No data found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
