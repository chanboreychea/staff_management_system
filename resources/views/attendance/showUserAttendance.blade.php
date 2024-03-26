@extends('frontend.layouts.master')

@section('contents')
<script>
    var bootstrapCSS = document.createElement('link');
       bootstrapCSS.href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css';
       bootstrapCSS.rel = 'stylesheet';
       bootstrapCSS.integrity = 'sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH';
       bootstrapCSS.crossOrigin = 'anonymous';

       // Append the link element to the document body
       document.body.appendChild(bootstrapCSS);
</script>
    <section class="section-box mt-120 fontKef1" style="font-size:12px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-50">
                    <div class="content-single">
                        <h3 class="mt-0 mb-0 color-brand-1 fontKef2" >វត្តមានរបស់អ្នក</h3><br>
                        {{-- <div class="dashboard_overview"> --}}

                        <div class="card">
                            <div class="card-header">
                                <form action="/attendances/{{ session('user_id') }}" action="GET">
                                    @csrf
                                    <div class="row d-flex align-items-center">

                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">From</span>
                                                <input type="date" name="fromDate"
                                                    min="{{ now()->subMonths(3)->format('Y-m-d') }}"
                                                    max="{{ now()->format('Y-m-d') }}" class="form-control"
                                                    aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">From</span>
                                                <input type="date" name="toDate" max="{{ now()->format('Y-m-d') }}"
                                                    class="form-control" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <input class="btn btn-sm btn-warning w-100 text-white" type="submit" value="Filter">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" style="font-family: Khmer, sans-serif">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align: center;" scope="col">ល.រ</th>
                                            <th style="text-align: center;" scope="col">កាលបរិច្ឆេទ</th>
                                            <th style="text-align: center;" scope="col">ច្បាប់</th>
                                            <th style="text-align: center;" scope="col">ម៉ោងចូល</th>
                                            <th style="text-align: center;" scope="col">ចូលយឺត</th>
                                            <th style="text-align: center;" scope="col">ម៉ោងចេញ</th>
                                            <th style="text-align: center;" scope="col">ចេញយឺត</th>
                                            <th style="text-align: center;" scope="col">បេសកកម្ម</th>
                                            <th style="text-align: center;" scope="col">សរុប</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $key => $item)
                                            <tr>
                                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                                <td style="text-align: center;">{{ $item->date }}</td>
                                                <td style="color: red; text-align: center;">{{ $item->leave }}</td>

                                                @if ($item->checkIn)
                                                    @if ($item->checkIn > '09:00:00')
                                                        <td style="color: red; text-align: center;">{{ $item->checkIn }}
                                                        </td>
                                                    @else
                                                        <td style="text-align: center;">{{ $item->checkIn }}</td>
                                                    @endif
                                                @else
                                                    <td style="text-align: center;">--:--:--</td>
                                                @endif

                                                <td style="color: red; text-align: center;">{{ $item->lateIn }}</td>

                                                @if ($item->checkOut)
                                                    @if ($item->checkOut < '04:00:00' && $item->checkOut > '17:30:00')
                                                        <td style="color: red; text-align: center;">
                                                            {{ $item->checkOut }}</td>
                                                    @elseif ($item->checkOut > '17:30:00')
                                                        <td style="color: red; text-align: center;">
                                                            {{ $item->checkOut }}</td>​
                                                    @else
                                                        <td style="text-align: center;">{{ $item->checkOut }}</td>
                                                    @endif
                                                @else
                                                    <td style="text-align: center;">--:--:--</td>
                                                @endif

                                                <td style="color: red; text-align: center;">{{ $item->lateOut }}</td>

                                                <td style="color: red; text-align: center;">{{ $item->mission }}</td>

                                                <td style="text-align: center;">
                                                    @if ($item->total)
                                                        {{ $item->total }}
                                                    @else
                                                        --:--:--
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="mt-120"></div> --}}
@endsection
