<nav class="progress bg-0 pt-20 pb-20">
    <div class="container">
        <div class="text-500 ma-0" style="display: table;">

            <div class="col-cell cell-icon pr-15"></div>

            <div class="col-cell text-400">
                <a href="#{{$tabs[0]['id']}}" aria-controls="{{$tabs[0]['id']}}" role="tab"
                   data-toggle="tab">{{$tabs[0]['title']}}</a>
            </div>

            <div class="col-cell pl-20 pr-20">|</div>


            <div class="col-cell cell-icon pr-15"></div>

            <div class="col-cell text-400">
                <a href="#{{$tabs[1]['id']}}" aria-controls="{{$tabs[1]['id']}}" role="tab"
                   data-toggle="tab">{{$tabs[1]['title']}}</a>
            </div>

            @if(!empty($project->inspection))
            @if(isset($tabs[2]))
                <div class="col-cell pl-20 pr-20">|</div>
                <div class="col-cell cell-icon pr-15"></div>
                <div class="col-cell text-400">
                    <a href="#{{$tabs[2]['id']}}" aria-controls="{{$tabs[2]['id']}}" role="tab"
                       data-toggle="tab">{{$tabs[2]['title']}}</a>
                </div>
            @endif
            @endif

            @if(isset($tabs[3]))
                <div class="col-cell pl-20 pr-20">|</div>
                <div class="col-cell cell-icon pr-15"></div>
                <div class="col-cell text-400">
                    <a href="#{{$tabs[3]['id']}}" aria-controls="{{$tabs[3]['id']}}" role="tab"
                       data-toggle="tab">{{$tabs[3]['title']}}</a>
                </div>
            @endif

            @if(isset($tabs[4]))
                <div class="col-cell pl-20 pr-20">|</div>
                <div class="col-cell cell-icon pr-15"></div>
                <div class="col-cell text-400">
                    <a href="#{{$tabs[4]['id']}}" aria-controls="{{$tabs[4]['id']}}" role="tab"
                       data-toggle="tab">{{$tabs[4]['title']}}</a>
                </div>
            @endif

            @if(isset($tabs[5]))
                <div class="col-cell pl-20 pr-20">|</div>
                <div class="col-cell cell-icon pr-15"></div>
                <div class="col-cell text-400">
                    <a href="#{{$tabs[5]['id']}}" aria-controls="{{$tabs[5]['id']}}" role="tab"
                       data-toggle="tab">{{$tabs[5]['title']}}</a>
                </div>
            @endif
        </div>
    </div>
</nav>
<hr class="ma-0">