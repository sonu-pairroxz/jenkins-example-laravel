<table>
    <thead>
        <tr>
            <th>Ticket ID</th>
            <th>User</th>
            <th>Title</th>
            <th>Description</th>
            <th>ASIN</th>
            <th>Work Stheam</th>
            <th>Marketplace</th>
            <th>Tariff Node</th>
            <th>Manager</th>
            <th>Ruling Referred</th>
            <th>External Links</th>
            <th>Document Referred</th>
            <th>No of NFA Parked</th>
            <th>ITK</th>
            <th>Requester Comment</th>
            <th>Resolver Comment</th>
            <th>Date Added</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($query as $q)
            <tr>
                <td>{{$q->ticket_id}}</td>
                <td>{{$q->user->first_name}}</td>
                <td>{{$q->title}}</td>
                <td>{{$q->description}}</td>
                <td>{{$q->asin}}</td>
                <td>{{$q->work_stream}}</td>
                <td>{{$q->marketplace}}</td>
                <td>{{$q->tariff_node}}</td>
                <td>{{$q->manager_id}}</td>
                <td>{{$q->ruling_referred}}</td>
                <td>{{$q->external_links}}</td>
                <td>{{$q->document_referred}}</td>
                <td>{{$q->no_of_nfa_parked}}</td>
                <td>{{$q->itk}}</td>
                <td>{{$q->requester_comment}}</td>
                <td>{{$q->resolver_comment}}</td>
                <td>{{ \Carbon\Carbon::parse($q->created_at)->format("d M, Y")}}</td>
            </tr>
        @empty
        <tr>
            <td colspan="17">No data found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
