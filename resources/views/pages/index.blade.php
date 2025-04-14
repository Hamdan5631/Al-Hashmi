@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
    @php
        $admin = \App\Models\Admin::query()->find(\Illuminate\Support\Facades\Auth::id());
    @endphp

    <div class="row">
        @if($admin->isSuperAdmin())
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-user"></i>
                            </div>

                        </div>
                        <span class="d-block">Employees</span>
                        <h4 class="card-title mb-1">{{\App\Models\Admin::query()->where('role','!=',\App\Enums\Admin\AdminRoles::SUPER_ADMIN)->count()}}</h4>
                        <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body pb-2" style="position: relative;">
                    <span class="d-block fw-medium">Stocks</span>

                    <h3 class="card-title mb-0">{{\App\Models\Product::all()->count()}}</h3>


                    <div id="profitChart" style="min-height: 95px;">
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-3 col-6 mb-4">
            <div class="card">
                <div class="card-body pb-2" style="position: relative;">
                    <span class="d-block fw-medium">
                        Total Stock Sold
                    </span>
                    <h3 class="card-title mb-0">
                        @if($admin->isSuperAdmin())
                            {{\App\Models\SoldProduct::all()->count()}}
                        @else
                            {{\App\Models\SoldProduct::query()->where('admin_id',\Illuminate\Support\Facades\Auth::id())->count()}}
                        @endif
                    </h3>
                    <div id="profitChart" style="min-height: 95px;">
                        <div id="apexcharts0mlon99z"
                             class="apexcharts-canvas apexcharts0mlon99z apexcharts-theme-light"
                             style="width: 162px; height: 80px;">
                            <svg id="SvgjsSvg1780" width="162" height="80"
                                 xmlns="http://www.w3.org/2000/svg" version="1.1"
                                 class="apexcharts-svg"
                                 xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                 style="background: transparent;">
                                <g id="SvgjsG1782" class="apexcharts-inner apexcharts-graphical"
                                   transform="translate(0, 0)">
                                    <defs id="SvgjsDefs1781">
                                        <linearGradient id="SvgjsLinearGradient1785" x1="0" y1="0"
                                                        x2="0" y2="1">
                                            <stop id="SvgjsStop1786" stop-opacity="0.4"
                                                  stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                            <stop id="SvgjsStop1787" stop-opacity="0.5"
                                                  stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                            <stop id="SvgjsStop1788" stop-opacity="0.5"
                                                  stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                        </linearGradient>
                                        <clipPath id="gridRectMask0mlon99z">
                                            <rect id="SvgjsRect1790" width="171" height="57.73" x="-4.5"
                                                  y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0"
                                                  stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="forecastMask0mlon99z"></clipPath>
                                        <clipPath id="nonForecastMask0mlon99z"></clipPath>
                                        <clipPath id="gridRectMarkerMask0mlon99z">
                                            <rect id="SvgjsRect1791" width="166" height="56.73" x="-2"
                                                  y="-2" rx="0" ry="0" opacity="1" stroke-width="0"
                                                  stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                    </defs>
                                    <rect id="SvgjsRect1789" width="13.1625" height="52.73" x="0" y="0"
                                          rx="0" ry="0" opacity="1" stroke-width="0"
                                          stroke-dasharray="3" fill="url(#SvgjsLinearGradient1785)"
                                          class="apexcharts-xcrosshairs" y2="52.73" filter="none"
                                          fill-opacity="0.9"></rect>
                                    <g id="SvgjsG1815" class="apexcharts-xaxis"
                                       transform="translate(0, 0)">
                                        <g id="SvgjsG1816" class="apexcharts-xaxis-texts-g"
                                           transform="translate(0, -4)">
                                            <text id="SvgjsText1818"
                                                  font-family="Helvetica, Arial, sans-serif" x="20.25"
                                                  y="81.72999999999999" text-anchor="middle"
                                                  dominant-baseline="auto" font-size="13px"
                                                  font-weight="400" fill="#a1acb8"
                                                  class="apexcharts-text apexcharts-xaxis-label "
                                                  style="font-family: Helvetica, Arial, sans-serif;">
                                                <tspan id="SvgjsTspan1819">Jan</tspan>
                                                <title>Jan</title></text>
                                            <text id="SvgjsText1821"
                                                  font-family="Helvetica, Arial, sans-serif" x="60.75"
                                                  y="81.72999999999999" text-anchor="middle"
                                                  dominant-baseline="auto" font-size="13px"
                                                  font-weight="400" fill="#a1acb8"
                                                  class="apexcharts-text apexcharts-xaxis-label "
                                                  style="font-family: Helvetica, Arial, sans-serif;">
                                                <tspan id="SvgjsTspan1822">Apr</tspan>
                                                <title>Apr</title></text>
                                            <text id="SvgjsText1824"
                                                  font-family="Helvetica, Arial, sans-serif" x="101.25"
                                                  y="81.72999999999999" text-anchor="middle"
                                                  dominant-baseline="auto" font-size="13px"
                                                  font-weight="400" fill="#a1acb8"
                                                  class="apexcharts-text apexcharts-xaxis-label "
                                                  style="font-family: Helvetica, Arial, sans-serif;">
                                                <tspan id="SvgjsTspan1825">Jul</tspan>
                                                <title>Jul</title></text>
                                            <text id="SvgjsText1827"
                                                  font-family="Helvetica, Arial, sans-serif" x="141.75"
                                                  y="81.72999999999999" text-anchor="middle"
                                                  dominant-baseline="auto" font-size="13px"
                                                  font-weight="400" fill="#a1acb8"
                                                  class="apexcharts-text apexcharts-xaxis-label "
                                                  style="font-family: Helvetica, Arial, sans-serif;">
                                                <tspan id="SvgjsTspan1828">Oct</tspan>
                                                <title>Oct</title></text>
                                        </g>
                                    </g>
                                    <g id="SvgjsG1831" class="apexcharts-grid">
                                        <g id="SvgjsG1832" class="apexcharts-gridlines-horizontal"
                                           style="display: none;">
                                            <line id="SvgjsLine1834" x1="0" y1="0" x2="162" y2="0"
                                                  stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1835" x1="0" y1="13.1825" x2="162"
                                                  y2="13.1825" stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1836" x1="0" y1="26.365" x2="162"
                                                  y2="26.365" stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1837" x1="0" y1="39.5475" x2="162"
                                                  y2="39.5475" stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1838" x1="0" y1="52.73" x2="162"
                                                  y2="52.73" stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                        </g>
                                        <g id="SvgjsG1833" class="apexcharts-gridlines-vertical"
                                           style="display: none;"></g>
                                        <line id="SvgjsLine1840" x1="0" y1="52.73" x2="162" y2="52.73"
                                              stroke="transparent" stroke-dasharray="0"
                                              stroke-linecap="butt"></line>
                                        <line id="SvgjsLine1839" x1="0" y1="1" x2="0" y2="52.73"
                                              stroke="transparent" stroke-dasharray="0"
                                              stroke-linecap="butt"></line>
                                    </g>
                                    <g id="SvgjsG1792"
                                       class="apexcharts-bar-series apexcharts-plot-series">
                                        <g id="SvgjsG1793" class="apexcharts-series" rel="1"
                                           seriesName="seriesx1" data:realIndex="0">
                                            <path id="SvgjsPath1797"
                                                  d="M 7.0875 49.73L 7.0875 17.500750000000004Q 7.0875 14.500750000000004 10.0875 14.500750000000004L 12.25 14.500750000000004Q 15.25 14.500750000000004 15.25 17.500750000000004L 15.25 17.500750000000004L 15.25 49.73Q 15.25 52.73 12.25 52.73L 10.0875 52.73Q 7.0875 52.73 7.0875 49.73z"
                                                  fill="rgba(113,221,55,0.85)" fill-opacity="1"
                                                  stroke="#" stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="0"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 7.0875 49.73L 7.0875 17.500750000000004Q 7.0875 14.500750000000004 10.0875 14.500750000000004L 12.25 14.500750000000004Q 15.25 14.500750000000004 15.25 17.500750000000004L 15.25 17.500750000000004L 15.25 49.73Q 15.25 52.73 12.25 52.73L 10.0875 52.73Q 7.0875 52.73 7.0875 49.73z"
                                                  pathFrom="M 7.0875 49.73L 7.0875 49.73L 15.25 49.73L 15.25 49.73L 15.25 49.73L 15.25 49.73L 15.25 49.73L 7.0875 49.73"
                                                  cy="14.500750000000004" cx="45.0875" j="0" val="58"
                                                  barHeight="38.22924999999999"
                                                  barWidth="13.1625"></path>
                                            <path id="SvgjsPath1799"
                                                  d="M 47.5875 49.73L 47.5875 37.2745Q 47.5875 34.2745 50.5875 34.2745L 52.75 34.2745Q 55.75 34.2745 55.75 37.2745L 55.75 37.2745L 55.75 49.73Q 55.75 52.73 52.75 52.73L 50.5875 52.73Q 47.5875 52.73 47.5875 49.73z"
                                                  fill="rgba(113,221,55,0.85)" fill-opacity="1"
                                                  stroke="#" stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="0"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 47.5875 49.73L 47.5875 37.2745Q 47.5875 34.2745 50.5875 34.2745L 52.75 34.2745Q 55.75 34.2745 55.75 37.2745L 55.75 37.2745L 55.75 49.73Q 55.75 52.73 52.75 52.73L 50.5875 52.73Q 47.5875 52.73 47.5875 49.73z"
                                                  pathFrom="M 47.5875 49.73L 47.5875 49.73L 55.75 49.73L 55.75 49.73L 55.75 49.73L 55.75 49.73L 55.75 49.73L 47.5875 49.73"
                                                  cy="34.2745" cx="85.5875" j="1" val="28"
                                                  barHeight="18.455499999999997"
                                                  barWidth="13.1625"></path>
                                            <path id="SvgjsPath1801"
                                                  d="M 88.0875 49.73L 88.0875 22.77375Q 88.0875 19.77375 91.0875 19.77375L 93.25 19.77375Q 96.25 19.77375 96.25 22.77375L 96.25 22.77375L 96.25 49.73Q 96.25 52.73 93.25 52.73L 91.0875 52.73Q 88.0875 52.73 88.0875 49.73z"
                                                  fill="rgba(113,221,55,0.85)" fill-opacity="1"
                                                  stroke="#" stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="0"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 88.0875 49.73L 88.0875 22.77375Q 88.0875 19.77375 91.0875 19.77375L 93.25 19.77375Q 96.25 19.77375 96.25 22.77375L 96.25 22.77375L 96.25 49.73Q 96.25 52.73 93.25 52.73L 91.0875 52.73Q 88.0875 52.73 88.0875 49.73z"
                                                  pathFrom="M 88.0875 49.73L 88.0875 49.73L 96.25 49.73L 96.25 49.73L 96.25 49.73L 96.25 49.73L 96.25 49.73L 88.0875 49.73"
                                                  cy="19.77375" cx="126.0875" j="2" val="50"
                                                  barHeight="32.95625" barWidth="13.1625"></path>
                                            <path id="SvgjsPath1803"
                                                  d="M 128.5875 49.73L 128.5875 3Q 128.5875 0 131.5875 0L 133.75 0Q 136.75 0 136.75 3L 136.75 3L 136.75 49.73Q 136.75 52.73 133.75 52.73L 131.5875 52.73Q 128.5875 52.73 128.5875 49.73z"
                                                  fill="rgba(113,221,55,0.85)" fill-opacity="1"
                                                  stroke="#" stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="0"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 128.5875 49.73L 128.5875 3Q 128.5875 0 131.5875 0L 133.75 0Q 136.75 0 136.75 3L 136.75 3L 136.75 49.73Q 136.75 52.73 133.75 52.73L 131.5875 52.73Q 128.5875 52.73 128.5875 49.73z"
                                                  pathFrom="M 128.5875 49.73L 128.5875 49.73L 136.75 49.73L 136.75 49.73L 136.75 49.73L 136.75 49.73L 136.75 49.73L 128.5875 49.73"
                                                  cy="0" cx="166.5875" j="3" val="80" barHeight="52.73"
                                                  barWidth="13.1625"></path>
                                            <g id="SvgjsG1795" class="apexcharts-bar-goals-markers"
                                               style="pointer-events: none">
                                                <g id="SvgjsG1796"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1798"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1800"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1802"
                                                   className="apexcharts-bar-goals-groups"></g>
                                            </g>
                                        </g>
                                        <g id="SvgjsG1804" class="apexcharts-series" rel="2"
                                           seriesName="seriesx2" data:realIndex="1">
                                            <path id="SvgjsPath1808"
                                                  d="M 20.25 49.73L 20.25 22.77375Q 20.25 19.77375 23.25 19.77375L 25.4125 19.77375Q 28.4125 19.77375 28.4125 22.77375L 28.4125 22.77375L 28.4125 49.73Q 28.4125 52.73 25.4125 52.73L 23.25 52.73Q 20.25 52.73 20.25 49.73z"
                                                  fill="#28d0941a" fill-opacity="1" stroke="a"
                                                  stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="1"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 20.25 49.73L 20.25 22.77375Q 20.25 19.77375 23.25 19.77375L 25.4125 19.77375Q 28.4125 19.77375 28.4125 22.77375L 28.4125 22.77375L 28.4125 49.73Q 28.4125 52.73 25.4125 52.73L 23.25 52.73Q 20.25 52.73 20.25 49.73z"
                                                  pathFrom="M 20.25 49.73L 20.25 49.73L 28.4125 49.73L 28.4125 49.73L 28.4125 49.73L 28.4125 49.73L 28.4125 49.73L 20.25 49.73"
                                                  cy="16.77375" cx="58.25" j="0" val="50"
                                                  barHeight="32.95625" barWidth="13.1625"></path>
                                            <path id="SvgjsPath1810"
                                                  d="M 60.75 49.73L 60.75 41.22925Q 60.75 38.22925 63.75 38.22925L 65.9125 38.22925Q 68.9125 38.22925 68.9125 41.22925L 68.9125 41.22925L 68.9125 49.73Q 68.9125 52.73 65.9125 52.73L 63.75 52.73Q 60.75 52.73 60.75 49.73z"
                                                  fill="#28d0941a" fill-opacity="1" stroke="a"
                                                  stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="1"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 60.75 49.73L 60.75 41.22925Q 60.75 38.22925 63.75 38.22925L 65.9125 38.22925Q 68.9125 38.22925 68.9125 41.22925L 68.9125 41.22925L 68.9125 49.73Q 68.9125 52.73 65.9125 52.73L 63.75 52.73Q 60.75 52.73 60.75 49.73z"
                                                  pathFrom="M 60.75 49.73L 60.75 49.73L 68.9125 49.73L 68.9125 49.73L 68.9125 49.73L 68.9125 49.73L 68.9125 49.73L 60.75 49.73"
                                                  cy="35.22925" cx="98.75" j="1" val="22"
                                                  barHeight="14.500749999999998"
                                                  barWidth="13.1625"></path>
                                            <path id="SvgjsPath1812"
                                                  d="M 101.25 49.73L 101.25 12.886875000000003Q 101.25 9.886875000000003 104.25 9.886875000000003L 106.4125 9.886875000000003Q 109.4125 9.886875000000003 109.4125 12.886875000000003L 109.4125 12.886875000000003L 109.4125 49.73Q 109.4125 52.73 106.4125 52.73L 104.25 52.73Q 101.25 52.73 101.25 49.73z"
                                                  fill="#28d0941a" fill-opacity="1" stroke="a"
                                                  stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="1"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 101.25 49.73L 101.25 12.886875000000003Q 101.25 9.886875000000003 104.25 9.886875000000003L 106.4125 9.886875000000003Q 109.4125 9.886875000000003 109.4125 12.886875000000003L 109.4125 12.886875000000003L 109.4125 49.73Q 109.4125 52.73 106.4125 52.73L 104.25 52.73Q 101.25 52.73 101.25 49.73z"
                                                  pathFrom="M 101.25 49.73L 101.25 49.73L 109.4125 49.73L 109.4125 49.73L 109.4125 49.73L 109.4125 49.73L 109.4125 49.73L 101.25 49.73"
                                                  cy="6.886875000000003" cx="139.25" j="2" val="65"
                                                  barHeight="42.84312499999999"
                                                  barWidth="13.1625"></path>
                                            <path id="SvgjsPath1814"
                                                  d="M 141.75 49.73L 141.75 8.273000000000003Q 141.75 5.273000000000003 144.75 5.273000000000003L 146.9125 5.273000000000003Q 149.9125 5.273000000000003 149.9125 8.273000000000003L 149.9125 8.273000000000003L 149.9125 49.73Q 149.9125 52.73 146.9125 52.73L 144.75 52.73Q 141.75 52.73 141.75 49.73z"
                                                  fill="#28d0941a" fill-opacity="1" stroke="a"
                                                  stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="1"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 141.75 49.73L 141.75 8.273000000000003Q 141.75 5.273000000000003 144.75 5.273000000000003L 146.9125 5.273000000000003Q 149.9125 5.273000000000003 149.9125 8.273000000000003L 149.9125 8.273000000000003L 149.9125 49.73Q 149.9125 52.73 146.9125 52.73L 144.75 52.73Q 141.75 52.73 141.75 49.73z"
                                                  pathFrom="M 141.75 49.73L 141.75 49.73L 149.9125 49.73L 149.9125 49.73L 149.9125 49.73L 149.9125 49.73L 149.9125 49.73L 141.75 49.73"
                                                  cy="2.2730000000000032" cx="179.75" j="3" val="72"
                                                  barHeight="47.456999999999994"
                                                  barWidth="13.1625"></path>
                                            <g id="SvgjsG1806" class="apexcharts-bar-goals-markers"
                                               style="pointer-events: none">
                                                <g id="SvgjsG1807"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1809"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1811"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1813"
                                                   className="apexcharts-bar-goals-groups"></g>
                                            </g>
                                        </g>
                                        <g id="SvgjsG1794" class="apexcharts-datalabels"
                                           data:realIndex="0"></g>
                                        <g id="SvgjsG1805" class="apexcharts-datalabels"
                                           data:realIndex="1"></g>
                                    </g>
                                    <line id="SvgjsLine1841" x1="0" y1="0" x2="162" y2="0"
                                          stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                          stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                    <line id="SvgjsLine1842" x1="0" y1="0" x2="162" y2="0"
                                          stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                          class="apexcharts-ycrosshairs-hidden"></line>
                                    <g id="SvgjsG1843" class="apexcharts-yaxis-annotations"></g>
                                    <g id="SvgjsG1844" class="apexcharts-xaxis-annotations"></g>
                                    <g id="SvgjsG1845" class="apexcharts-point-annotations"></g>
                                </g>
                                <g id="SvgjsG1829" class="apexcharts-yaxis" rel="0"
                                   transform="translate(-8, 0)">
                                    <g id="SvgjsG1830" class="apexcharts-yaxis-texts-g"></g>
                                </g>
                                <g id="SvgjsG1783" class="apexcharts-annotations"></g>
                            </svg>
                            <div class="apexcharts-legend" style="max-height: 40px;"></div>
                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                <div class="apexcharts-tooltip-title"
                                     style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                        class="apexcharts-tooltip-marker"
                                        style="background-color: rgb(113, 221, 55);"></span>
                                    <div class="apexcharts-tooltip-text"
                                         style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span>
                                        </div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                                <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                        class="apexcharts-tooltip-marker"
                                        style="background-color: rgba(40, 208, 148, 0.1);"></span>
                                    <div class="apexcharts-tooltip-text"
                                         style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span>
                                        </div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                <div class="apexcharts-yaxistooltip-text"></div>
                            </div>
                            <div class="apexcharts-toolbar" style="top: 0px; right: 3px;">
                                <div class="apexcharts-menu">
                                    <div class="apexcharts-menu-item exportSVG" title="Download SVG">
                                        Download SVG
                                    </div>
                                    <div class="apexcharts-menu-item exportPNG" title="Download PNG">
                                        Download PNG
                                    </div>
                                    <div class="apexcharts-menu-item exportCSV" title="Download CSV">
                                        Download CSV
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resize-triggers">
                        <div class="expand-trigger">
                            <div style="width: 211px; height: 180px;"></div>
                        </div>
                        <div class="contract-trigger"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-3 col-6 mb-4">
            <div class="card">
                <div class="card-body pb-2" style="position: relative;">
                    <span class="d-block fw-medium">
                        @if($admin->isSuperAdmin())
                            Total Sales (AED)
                        @else
                            Total Sales by You (AED)
                        @endif
                    </span>
                    <h3 class="card-title mb-0">
                        @if($admin->isSuperAdmin())
                            {{number_format(\App\Models\SoldProduct::sum('selling_price'))}}
                        @else
                            {{number_format(\App\Models\SoldProduct::query()->where('admin_id',\Illuminate\Support\Facades\Auth::id())->sum('selling_price'))}}
                        @endif
                    </h3>
                    <div id="profitChart" style="min-height: 95px;">
                        <div id="apexcharts0mlon99z"
                             class="apexcharts-canvas apexcharts0mlon99z apexcharts-theme-light"
                             style="width: 162px; height: 80px;">
                            <svg id="SvgjsSvg1780" width="162" height="80"
                                 xmlns="http://www.w3.org/2000/svg" version="1.1"
                                 class="apexcharts-svg"
                                 xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                 style="background: transparent;">
                                <g id="SvgjsG1782" class="apexcharts-inner apexcharts-graphical"
                                   transform="translate(0, 0)">
                                    <defs id="SvgjsDefs1781">
                                        <linearGradient id="SvgjsLinearGradient1785" x1="0" y1="0"
                                                        x2="0" y2="1">
                                            <stop id="SvgjsStop1786" stop-opacity="0.4"
                                                  stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                            <stop id="SvgjsStop1787" stop-opacity="0.5"
                                                  stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                            <stop id="SvgjsStop1788" stop-opacity="0.5"
                                                  stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                        </linearGradient>
                                        <clipPath id="gridRectMask0mlon99z">
                                            <rect id="SvgjsRect1790" width="171" height="57.73" x="-4.5"
                                                  y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0"
                                                  stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="forecastMask0mlon99z"></clipPath>
                                        <clipPath id="nonForecastMask0mlon99z"></clipPath>
                                        <clipPath id="gridRectMarkerMask0mlon99z">
                                            <rect id="SvgjsRect1791" width="166" height="56.73" x="-2"
                                                  y="-2" rx="0" ry="0" opacity="1" stroke-width="0"
                                                  stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                    </defs>
                                    <rect id="SvgjsRect1789" width="13.1625" height="52.73" x="0" y="0"
                                          rx="0" ry="0" opacity="1" stroke-width="0"
                                          stroke-dasharray="3" fill="url(#SvgjsLinearGradient1785)"
                                          class="apexcharts-xcrosshairs" y2="52.73" filter="none"
                                          fill-opacity="0.9"></rect>
                                    <g id="SvgjsG1815" class="apexcharts-xaxis"
                                       transform="translate(0, 0)">
                                        <g id="SvgjsG1816" class="apexcharts-xaxis-texts-g"
                                           transform="translate(0, -4)">
                                            <text id="SvgjsText1818"
                                                  font-family="Helvetica, Arial, sans-serif" x="20.25"
                                                  y="81.72999999999999" text-anchor="middle"
                                                  dominant-baseline="auto" font-size="13px"
                                                  font-weight="400" fill="#a1acb8"
                                                  class="apexcharts-text apexcharts-xaxis-label "
                                                  style="font-family: Helvetica, Arial, sans-serif;">
                                                <tspan id="SvgjsTspan1819">Jan</tspan>
                                                <title>Jan</title></text>
                                            <text id="SvgjsText1821"
                                                  font-family="Helvetica, Arial, sans-serif" x="60.75"
                                                  y="81.72999999999999" text-anchor="middle"
                                                  dominant-baseline="auto" font-size="13px"
                                                  font-weight="400" fill="#a1acb8"
                                                  class="apexcharts-text apexcharts-xaxis-label "
                                                  style="font-family: Helvetica, Arial, sans-serif;">
                                                <tspan id="SvgjsTspan1822">Apr</tspan>
                                                <title>Apr</title></text>
                                            <text id="SvgjsText1824"
                                                  font-family="Helvetica, Arial, sans-serif" x="101.25"
                                                  y="81.72999999999999" text-anchor="middle"
                                                  dominant-baseline="auto" font-size="13px"
                                                  font-weight="400" fill="#a1acb8"
                                                  class="apexcharts-text apexcharts-xaxis-label "
                                                  style="font-family: Helvetica, Arial, sans-serif;">
                                                <tspan id="SvgjsTspan1825">Jul</tspan>
                                                <title>Jul</title></text>
                                            <text id="SvgjsText1827"
                                                  font-family="Helvetica, Arial, sans-serif" x="141.75"
                                                  y="81.72999999999999" text-anchor="middle"
                                                  dominant-baseline="auto" font-size="13px"
                                                  font-weight="400" fill="#a1acb8"
                                                  class="apexcharts-text apexcharts-xaxis-label "
                                                  style="font-family: Helvetica, Arial, sans-serif;">
                                                <tspan id="SvgjsTspan1828">Oct</tspan>
                                                <title>Oct</title></text>
                                        </g>
                                    </g>
                                    <g id="SvgjsG1831" class="apexcharts-grid">
                                        <g id="SvgjsG1832" class="apexcharts-gridlines-horizontal"
                                           style="display: none;">
                                            <line id="SvgjsLine1834" x1="0" y1="0" x2="162" y2="0"
                                                  stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1835" x1="0" y1="13.1825" x2="162"
                                                  y2="13.1825" stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1836" x1="0" y1="26.365" x2="162"
                                                  y2="26.365" stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1837" x1="0" y1="39.5475" x2="162"
                                                  y2="39.5475" stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1838" x1="0" y1="52.73" x2="162"
                                                  y2="52.73" stroke="#e0e0e0" stroke-dasharray="0"
                                                  stroke-linecap="butt"
                                                  class="apexcharts-gridline"></line>
                                        </g>
                                        <g id="SvgjsG1833" class="apexcharts-gridlines-vertical"
                                           style="display: none;"></g>
                                        <line id="SvgjsLine1840" x1="0" y1="52.73" x2="162" y2="52.73"
                                              stroke="transparent" stroke-dasharray="0"
                                              stroke-linecap="butt"></line>
                                        <line id="SvgjsLine1839" x1="0" y1="1" x2="0" y2="52.73"
                                              stroke="transparent" stroke-dasharray="0"
                                              stroke-linecap="butt"></line>
                                    </g>
                                    <g id="SvgjsG1792"
                                       class="apexcharts-bar-series apexcharts-plot-series">
                                        <g id="SvgjsG1793" class="apexcharts-series" rel="1"
                                           seriesName="seriesx1" data:realIndex="0">
                                            <path id="SvgjsPath1797"
                                                  d="M 7.0875 49.73L 7.0875 17.500750000000004Q 7.0875 14.500750000000004 10.0875 14.500750000000004L 12.25 14.500750000000004Q 15.25 14.500750000000004 15.25 17.500750000000004L 15.25 17.500750000000004L 15.25 49.73Q 15.25 52.73 12.25 52.73L 10.0875 52.73Q 7.0875 52.73 7.0875 49.73z"
                                                  fill="rgba(113,221,55,0.85)" fill-opacity="1"
                                                  stroke="#" stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="0"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 7.0875 49.73L 7.0875 17.500750000000004Q 7.0875 14.500750000000004 10.0875 14.500750000000004L 12.25 14.500750000000004Q 15.25 14.500750000000004 15.25 17.500750000000004L 15.25 17.500750000000004L 15.25 49.73Q 15.25 52.73 12.25 52.73L 10.0875 52.73Q 7.0875 52.73 7.0875 49.73z"
                                                  pathFrom="M 7.0875 49.73L 7.0875 49.73L 15.25 49.73L 15.25 49.73L 15.25 49.73L 15.25 49.73L 15.25 49.73L 7.0875 49.73"
                                                  cy="14.500750000000004" cx="45.0875" j="0" val="58"
                                                  barHeight="38.22924999999999"
                                                  barWidth="13.1625"></path>
                                            <path id="SvgjsPath1799"
                                                  d="M 47.5875 49.73L 47.5875 37.2745Q 47.5875 34.2745 50.5875 34.2745L 52.75 34.2745Q 55.75 34.2745 55.75 37.2745L 55.75 37.2745L 55.75 49.73Q 55.75 52.73 52.75 52.73L 50.5875 52.73Q 47.5875 52.73 47.5875 49.73z"
                                                  fill="rgba(113,221,55,0.85)" fill-opacity="1"
                                                  stroke="#" stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="0"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 47.5875 49.73L 47.5875 37.2745Q 47.5875 34.2745 50.5875 34.2745L 52.75 34.2745Q 55.75 34.2745 55.75 37.2745L 55.75 37.2745L 55.75 49.73Q 55.75 52.73 52.75 52.73L 50.5875 52.73Q 47.5875 52.73 47.5875 49.73z"
                                                  pathFrom="M 47.5875 49.73L 47.5875 49.73L 55.75 49.73L 55.75 49.73L 55.75 49.73L 55.75 49.73L 55.75 49.73L 47.5875 49.73"
                                                  cy="34.2745" cx="85.5875" j="1" val="28"
                                                  barHeight="18.455499999999997"
                                                  barWidth="13.1625"></path>
                                            <path id="SvgjsPath1801"
                                                  d="M 88.0875 49.73L 88.0875 22.77375Q 88.0875 19.77375 91.0875 19.77375L 93.25 19.77375Q 96.25 19.77375 96.25 22.77375L 96.25 22.77375L 96.25 49.73Q 96.25 52.73 93.25 52.73L 91.0875 52.73Q 88.0875 52.73 88.0875 49.73z"
                                                  fill="rgba(113,221,55,0.85)" fill-opacity="1"
                                                  stroke="#" stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="0"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 88.0875 49.73L 88.0875 22.77375Q 88.0875 19.77375 91.0875 19.77375L 93.25 19.77375Q 96.25 19.77375 96.25 22.77375L 96.25 22.77375L 96.25 49.73Q 96.25 52.73 93.25 52.73L 91.0875 52.73Q 88.0875 52.73 88.0875 49.73z"
                                                  pathFrom="M 88.0875 49.73L 88.0875 49.73L 96.25 49.73L 96.25 49.73L 96.25 49.73L 96.25 49.73L 96.25 49.73L 88.0875 49.73"
                                                  cy="19.77375" cx="126.0875" j="2" val="50"
                                                  barHeight="32.95625" barWidth="13.1625"></path>
                                            <path id="SvgjsPath1803"
                                                  d="M 128.5875 49.73L 128.5875 3Q 128.5875 0 131.5875 0L 133.75 0Q 136.75 0 136.75 3L 136.75 3L 136.75 49.73Q 136.75 52.73 133.75 52.73L 131.5875 52.73Q 128.5875 52.73 128.5875 49.73z"
                                                  fill="rgba(113,221,55,0.85)" fill-opacity="1"
                                                  stroke="#" stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="0"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 128.5875 49.73L 128.5875 3Q 128.5875 0 131.5875 0L 133.75 0Q 136.75 0 136.75 3L 136.75 3L 136.75 49.73Q 136.75 52.73 133.75 52.73L 131.5875 52.73Q 128.5875 52.73 128.5875 49.73z"
                                                  pathFrom="M 128.5875 49.73L 128.5875 49.73L 136.75 49.73L 136.75 49.73L 136.75 49.73L 136.75 49.73L 136.75 49.73L 128.5875 49.73"
                                                  cy="0" cx="166.5875" j="3" val="80" barHeight="52.73"
                                                  barWidth="13.1625"></path>
                                            <g id="SvgjsG1795" class="apexcharts-bar-goals-markers"
                                               style="pointer-events: none">
                                                <g id="SvgjsG1796"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1798"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1800"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1802"
                                                   className="apexcharts-bar-goals-groups"></g>
                                            </g>
                                        </g>
                                        <g id="SvgjsG1804" class="apexcharts-series" rel="2"
                                           seriesName="seriesx2" data:realIndex="1">
                                            <path id="SvgjsPath1808"
                                                  d="M 20.25 49.73L 20.25 22.77375Q 20.25 19.77375 23.25 19.77375L 25.4125 19.77375Q 28.4125 19.77375 28.4125 22.77375L 28.4125 22.77375L 28.4125 49.73Q 28.4125 52.73 25.4125 52.73L 23.25 52.73Q 20.25 52.73 20.25 49.73z"
                                                  fill="#28d0941a" fill-opacity="1" stroke="a"
                                                  stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="1"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 20.25 49.73L 20.25 22.77375Q 20.25 19.77375 23.25 19.77375L 25.4125 19.77375Q 28.4125 19.77375 28.4125 22.77375L 28.4125 22.77375L 28.4125 49.73Q 28.4125 52.73 25.4125 52.73L 23.25 52.73Q 20.25 52.73 20.25 49.73z"
                                                  pathFrom="M 20.25 49.73L 20.25 49.73L 28.4125 49.73L 28.4125 49.73L 28.4125 49.73L 28.4125 49.73L 28.4125 49.73L 20.25 49.73"
                                                  cy="16.77375" cx="58.25" j="0" val="50"
                                                  barHeight="32.95625" barWidth="13.1625"></path>
                                            <path id="SvgjsPath1810"
                                                  d="M 60.75 49.73L 60.75 41.22925Q 60.75 38.22925 63.75 38.22925L 65.9125 38.22925Q 68.9125 38.22925 68.9125 41.22925L 68.9125 41.22925L 68.9125 49.73Q 68.9125 52.73 65.9125 52.73L 63.75 52.73Q 60.75 52.73 60.75 49.73z"
                                                  fill="#28d0941a" fill-opacity="1" stroke="a"
                                                  stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="1"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 60.75 49.73L 60.75 41.22925Q 60.75 38.22925 63.75 38.22925L 65.9125 38.22925Q 68.9125 38.22925 68.9125 41.22925L 68.9125 41.22925L 68.9125 49.73Q 68.9125 52.73 65.9125 52.73L 63.75 52.73Q 60.75 52.73 60.75 49.73z"
                                                  pathFrom="M 60.75 49.73L 60.75 49.73L 68.9125 49.73L 68.9125 49.73L 68.9125 49.73L 68.9125 49.73L 68.9125 49.73L 60.75 49.73"
                                                  cy="35.22925" cx="98.75" j="1" val="22"
                                                  barHeight="14.500749999999998"
                                                  barWidth="13.1625"></path>
                                            <path id="SvgjsPath1812"
                                                  d="M 101.25 49.73L 101.25 12.886875000000003Q 101.25 9.886875000000003 104.25 9.886875000000003L 106.4125 9.886875000000003Q 109.4125 9.886875000000003 109.4125 12.886875000000003L 109.4125 12.886875000000003L 109.4125 49.73Q 109.4125 52.73 106.4125 52.73L 104.25 52.73Q 101.25 52.73 101.25 49.73z"
                                                  fill="#28d0941a" fill-opacity="1" stroke="a"
                                                  stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="1"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 101.25 49.73L 101.25 12.886875000000003Q 101.25 9.886875000000003 104.25 9.886875000000003L 106.4125 9.886875000000003Q 109.4125 9.886875000000003 109.4125 12.886875000000003L 109.4125 12.886875000000003L 109.4125 49.73Q 109.4125 52.73 106.4125 52.73L 104.25 52.73Q 101.25 52.73 101.25 49.73z"
                                                  pathFrom="M 101.25 49.73L 101.25 49.73L 109.4125 49.73L 109.4125 49.73L 109.4125 49.73L 109.4125 49.73L 109.4125 49.73L 101.25 49.73"
                                                  cy="6.886875000000003" cx="139.25" j="2" val="65"
                                                  barHeight="42.84312499999999"
                                                  barWidth="13.1625"></path>
                                            <path id="SvgjsPath1814"
                                                  d="M 141.75 49.73L 141.75 8.273000000000003Q 141.75 5.273000000000003 144.75 5.273000000000003L 146.9125 5.273000000000003Q 149.9125 5.273000000000003 149.9125 8.273000000000003L 149.9125 8.273000000000003L 149.9125 49.73Q 149.9125 52.73 146.9125 52.73L 144.75 52.73Q 141.75 52.73 141.75 49.73z"
                                                  fill="#28d0941a" fill-opacity="1" stroke="a"
                                                  stroke-opacity="1" stroke-linecap="round"
                                                  stroke-width="5" stroke-dasharray="0"
                                                  class="apexcharts-bar-area" index="1"
                                                  clip-path="url(#gridRectMask0mlon99z)"
                                                  pathTo="M 141.75 49.73L 141.75 8.273000000000003Q 141.75 5.273000000000003 144.75 5.273000000000003L 146.9125 5.273000000000003Q 149.9125 5.273000000000003 149.9125 8.273000000000003L 149.9125 8.273000000000003L 149.9125 49.73Q 149.9125 52.73 146.9125 52.73L 144.75 52.73Q 141.75 52.73 141.75 49.73z"
                                                  pathFrom="M 141.75 49.73L 141.75 49.73L 149.9125 49.73L 149.9125 49.73L 149.9125 49.73L 149.9125 49.73L 149.9125 49.73L 141.75 49.73"
                                                  cy="2.2730000000000032" cx="179.75" j="3" val="72"
                                                  barHeight="47.456999999999994"
                                                  barWidth="13.1625"></path>
                                            <g id="SvgjsG1806" class="apexcharts-bar-goals-markers"
                                               style="pointer-events: none">
                                                <g id="SvgjsG1807"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1809"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1811"
                                                   className="apexcharts-bar-goals-groups"></g>
                                                <g id="SvgjsG1813"
                                                   className="apexcharts-bar-goals-groups"></g>
                                            </g>
                                        </g>
                                        <g id="SvgjsG1794" class="apexcharts-datalabels"
                                           data:realIndex="0"></g>
                                        <g id="SvgjsG1805" class="apexcharts-datalabels"
                                           data:realIndex="1"></g>
                                    </g>
                                    <line id="SvgjsLine1841" x1="0" y1="0" x2="162" y2="0"
                                          stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                          stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                    <line id="SvgjsLine1842" x1="0" y1="0" x2="162" y2="0"
                                          stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                          class="apexcharts-ycrosshairs-hidden"></line>
                                    <g id="SvgjsG1843" class="apexcharts-yaxis-annotations"></g>
                                    <g id="SvgjsG1844" class="apexcharts-xaxis-annotations"></g>
                                    <g id="SvgjsG1845" class="apexcharts-point-annotations"></g>
                                </g>
                                <g id="SvgjsG1829" class="apexcharts-yaxis" rel="0"
                                   transform="translate(-8, 0)">
                                    <g id="SvgjsG1830" class="apexcharts-yaxis-texts-g"></g>
                                </g>
                                <g id="SvgjsG1783" class="apexcharts-annotations"></g>
                            </svg>
                            <div class="apexcharts-legend" style="max-height: 40px;"></div>
                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                <div class="apexcharts-tooltip-title"
                                     style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                        class="apexcharts-tooltip-marker"
                                        style="background-color: rgb(113, 221, 55);"></span>
                                    <div class="apexcharts-tooltip-text"
                                         style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span>
                                        </div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                                <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                        class="apexcharts-tooltip-marker"
                                        style="background-color: rgba(40, 208, 148, 0.1);"></span>
                                    <div class="apexcharts-tooltip-text"
                                         style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span>
                                        </div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                <div class="apexcharts-yaxistooltip-text"></div>
                            </div>
                            <div class="apexcharts-toolbar" style="top: 0px; right: 3px;">
                                <div class="apexcharts-menu">
                                    <div class="apexcharts-menu-item exportSVG" title="Download SVG">
                                        Download SVG
                                    </div>
                                    <div class="apexcharts-menu-item exportPNG" title="Download PNG">
                                        Download PNG
                                    </div>
                                    <div class="apexcharts-menu-item exportCSV" title="Download CSV">
                                        Download CSV
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resize-triggers">
                        <div class="expand-trigger">
                            <div style="width: 211px; height: 180px;"></div>
                        </div>
                        <div class="contract-trigger"></div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
