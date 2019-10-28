    <div class="table">
        <div class="table-heading">
            <h4>Spending History</h4>
        </div>
        <div class="table-body">
            @if(count($histories) < 1)
                <p align="center">No records to show</p>
            @else
                <table class="table-main">
                    <thead>
                        <th>#</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </thead>

                    <tbody id="records-table-body">                
                        @foreach($histories as $key => $history)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$history->description}}</td>
                                <td>₦{{number_format($history->amount)}}</td>
                                <td>{{date("j M Y h:i:s A", strtotime($history->created_at))}}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            @endif
        </div>
        <div class="table-footer">
            <span class="items-shown">
                <span id="shown">{{count($histories) > 0 ? "1 - ".count($histories) : "0"}} </span> of {{$total}}
            </span>
            <div class="pagination" id="pagination">
                @if(count($histories) > 0)
                    <ul class="pag-links">
                        <li><span class="pag-link disabled icon" id="previous">
                            <span data-feather="chevron-left" class="pag-icon"></span>
                        </span></li>
                        <li><span class="pag-link active" data-start="1">1</span></li>
                        <?php $count = floor($total/10) ?>
                        @for ($i = 0; $i < $count ; $i++)
                            <li><span class="pag-link" data-start="{{$i + 2}}">{{$i + 2}}</span></li>
                        @endfor
                        <li><span class="pag-link icon {{$count < 1 ? "disabled" : "" }}" id="next">
                            <span data-feather="chevron-right" class="pag-icon"></span>
                        </span></li>
                    </ul>
                @endunless
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.itemsCount = Number({{$total}});
    </script>