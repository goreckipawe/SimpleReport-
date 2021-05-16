<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Raport odsetek</title>

    <!-- Scripts -->
    <script src="{{ URL::asset('shared/jquery/jquery-3.4.1.js') }}" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('shared/bootstrap/js/bootstrap.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('shared/fontawesome/js/all.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('shared/bootstrap/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('shared/font-awesome/css/font-awesome.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('shared/ionicons/css/ionicons.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 centering" style="text-align: center; height: 150px;">
            <h1><b>Raport odsetek</b></h1>
        </div>
    </div>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active tab_a" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Raport odsetek za instalację</a>
        <a class="nav-item nav-link tab_a" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Szczegółowy raport odsetek za instalacje</a>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="color: white;">
            @foreach ($data["report_simplifies_version"] as $installations_row)
                <div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12" style="background-color: #4E4C67; height: 40px;">
                    <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Klient:</b>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            {{$installations_row->customer_name}}
                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Miejsce instalacji:</b>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            {{$installations_row->city}}
                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Segment instalacji:</b>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            {{$installations_row->segment}}
                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Koszt instalacji:</b>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            {{$installations_row->cost}} zł
                        </div>
                    </div>
                </div>
                <div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12" style="background-color: #4E4C67; height: 40px;">
                    <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Data instalacji:</b>
                        </div>
                        @if ($installations_row->installation_date != null)
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                {{$installations_row->installation_date}}
                            </div>
                        @else
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center; color: red">
                                Nie zrealizowano instalacji!
                            </div>
                        @endif
                    </div>
                    <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Czas instalacji:</b>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            {{$installations_row->installation_time}}
                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Dni na instalację:</b>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            {{$installations_row->days_to_install}}
                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 centering" style="text-align: center;">
                            <b>Możliwa kara umowna za instalację:</b>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 centering" style="text-align: center;">
                            %{{$installations_row->penalty}} of cost
                        </div>
                    </div>
                </div>
                <div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12" style="background-color: #4E4C67; height: 40px; border-bottom: 4px solid #A6B1E1;">
                    <div class="row col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Przekroczony czas instalacji:</b>
                        </div>
                        @if ($installations_row->installation_time <= $installations_row->days_to_install)
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                Nie
                            </div>
                        @else
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center; color: red">
                                Tak
                            </div>
                        @endif
                    </div>
                    <div class="row col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Kwota kary za instalację:</b>
                        </div>
                        @if ($installations_row->installation_time <= $installations_row->days_to_install)
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                0 zł
                            </div>
                        @else
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center; color: red;">
                                {{$installations_row->cost * $installations_row->penalty/100}} zł
                            </div>
                        @endif
                    </div>
                    <div class="row col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            <b>Możliwa kwota kary za instalację:</b>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                            {{$installations_row->cost * $installations_row->penalty/100}} zł
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab" style="color: white;">
            @foreach ($data["report"] as $row)
                <div class="row" style="background-color: #4E4C67;">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 centering" style="text-align: center; height: 40px; margin-top: 20px;">
                        <h3>Dane klienta: {{$row->customer_name}}</h3>
                    </div>
                </div>
                <div class="row" style="background-color: #4E4C67;">
                    <div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12" style="height: 60px;">
                        <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                <b>Klient:</b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                {{$row->customer_name}}
                            </div>
                        </div>
                        <div class="row col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                <b>Segment klienta:</b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                {{$row->segment}}
                            </div>
                        </div>
                        <div class="row col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                <b>Miasto klienta:</b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                {{$row->city->name}}
                            </div>
                        </div>
                        <div class="row col-sm-12 col-md-12 col-lg-2 col-xl-2">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                <b>Dni na instalację:</b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                {{$row->penalty["days_to_install"]}}
                            </div>
                        </div>
                        <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 centering" style="text-align: center;">
                                <b>Możliwa kara umowna dla klienta:</b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 centering" style="text-align: center;">
                                %{{$row->penalty["penalty"]}} of cost
                            </div>
                        </div>
                    </div>
                    <div class="row" style="background-color: #4E4C67; width: 100%; padding-top: 20px; border-bottom: 4px solid #A6B1E1;">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 centering" style="text-align: center; height: 40px;">
                            <h3>Instalacje</h3>
                        </div>
                    </div>
                    @foreach ($row->installations as $installations_row)
                        <div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12" style="background-color: #615169; height: 40px;">
                            <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Miejsce instalacji:</b>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    {{$installations_row->city->name}}
                                </div>
                            </div>
                            <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Segment instalacji:</b>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    {{$installations_row->segment}}
                                </div>
                            </div>
                            <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Koszt instalacji:</b>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    {{$installations_row->cost}} zł
                                </div>
                            </div>
                            <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Data zamówienia:</b>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    {{$installations_row->order_date}}
                                </div>
                            </div>
                        </div>
                        <div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12" style="background-color: #615169; height: 40px;">
                            <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Data instalacji:</b>
                                </div>
                                @if ($installations_row->installation_date != null)
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                        {{$installations_row->installation_date}}
                                    </div>
                                @else
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center; color: red">
                                        Nie zrealizowano instalacji!
                                    </div>
                                @endif
                            </div>
                            <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Czas instalacji:</b>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    {{$installations_row->installation_time}}
                                </div>
                            </div>
                            <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Dni na instalację:</b>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    {{$installations_row->penalty["days_to_install"]}}
                                </div>
                            </div>
                            <div class="row col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 centering" style="text-align: center;">
                                    <b>Możliwa kara umowna za instalację:</b>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 centering" style="text-align: center;">
                                    %{{$installations_row->penalty["penalty"]}} of cost
                                </div>
                            </div>
                        </div>
                        <div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12" style="background-color: #615169; height: 40px; border-bottom: 4px solid #A6B1E1;">
                            <div class="row col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Przekroczony czas instalacji:</b>
                                </div>
                                @if ($installations_row->penalty_for_exceeding_the_deadline == 0)
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                        Nie
                                    </div>
                                @else
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center; color: red">
                                        Tak
                                    </div>
                                @endif
                            </div>
                            <div class="row col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Kwota kary za instalację:</b>
                                </div>
                                @if ($installations_row->penalty_for_exceeding_the_deadline == 0)
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                        {{$installations_row->penalty_for_exceeding_the_deadline}} zł
                                    </div>
                                @else
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center; color: red;">
                                        {{$installations_row->penalty_for_exceeding_the_deadline}} zł
                                    </div>
                                @endif
                            </div>
                            <div class="row col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    <b>Możliwa kwota kary za instalację:</b>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 centering" style="text-align: center;">
                                    {{$installations_row->possible_penalty_for_exceeding_the_deadline}} zł
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
