<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Marketplace</th>
            <th>Type</th>
            <th>Date of publish</th>
            <th>Date of change applied</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($news as $q)
            <tr>
                <td>{{$q->title}}</td>
                <td>{{$q->marketplace}}</td>
                <td>{{$q->type}}</td>
                <td>{{ \Carbon\Carbon::parse($q->date_of_publish)->format("d M, Y")}}</td>
                <td>{{ \Carbon\Carbon::parse($q->date_of_change_applied)->format("d M, Y")}}</td>
                <td>{!! $q->description !!}</td>
            </tr>
        @empty
        <tr>
            <td colspan="17">No data found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
