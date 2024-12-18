<div class="container" style="border: 1px solid #000;">
    <div class="p-2 mb-4">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist" wire:ignore>
            <li class="nav-item" role="presentation">
                <a data-mdb-toggle="pill" class="nav-link active" id="ex2-tab-1" href="#ex2-tabs-1" role="tab"
                    aria-controls="ex2-tabs-1" aria-selected="true">Detecting summary</a>
            </li>
            <li class="nav-item" role="presentation">
                <a data-mdb-toggle="pill" class="nav-link" id="ex2-tab-2" href="#ex2-tabs-2" role="tab"
                    aria-controls="ex2-tabs-2" aria-selected="false">Recording attempt</a>
            </li>

        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex2-content">

            <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1"
                wire:ignore>

                <h5>Detecting Summary</h5>
                <p>Summary of the detecting activities will appear here.</p>

                <div class="row">
                    <div class="col-md-12">
                        <canvas class="col-sm-12 col-md-10 col-xl-8 mb-4" data-mdb-chart="bar"
                            data-mdb-dataset-label="Detecting Summary for October"
                            data-mdb-labels='["Week 1", "Week 2", "Week 3", "Week 4"]'
                            data-mdb-dataset-data="[10, 15, 8, 12]"
                            data-mdb-dataset-background-color='["rgba(75, 192, 192, 0.6)", "rgba(54, 162, 235, 0.6)", "rgba(255, 206, 86, 0.6)", "rgba(153, 102, 255, 0.6)"]'
                            data-mdb-dataset-border-color='["rgba(75, 192, 192, 1)", "rgba(54, 162, 235, 1)", "rgba(255, 206, 86, 1)", "rgba(153, 102, 255, 1)"]'
                            data-mdb-dataset-border-width="1"></canvas>
                    </div>

                    {{-- <div class="col-md-6">
                        <canvas id="doughnut-chart"></canvas>
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- Meetings Table -->
                        <div class="table-responsive text-center">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th class="th-sm"><strong>Meeting ID</strong></th>
                                        <th class="th-sm"><strong>Title</strong></th>
                                        <th class="th-sm"><strong>Participants</strong></th>
                                        <th class="th-sm"><strong>Number of Attempts</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>372976</td>
                                        <td>LiGAURD</td>
                                        <td>10</td>
                                        <td>
                                            <a target="_blank"
                                                href="{{ asset('assets/admin/pdf/Privacy infringement.pdf') }}">1</a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <!-- Table Pagination -->
                        <div class="d-flex justify-content-between mt-4">

                            <nav aria-label="...">
                                <ul class="pagination pagination-circle">
                                    {{ $meetings->withQueryString()->onEachSide(0)->links() }}
                                </ul>
                            </nav>

                            <div class="col-md-1" wire:ignore>
                                <select class="select" wire:model.live="pagination">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                        </div>
                        <!-- Table Pagination -->
                    </div>
                </div>



            </div>


            <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2" wire:ignore.self>
                <div class="container-fluid">
                    <h5>Recording Attempt</h5>
                    <p>Details of any recording attempt will appear here.</p>
                    <div class="p-0 mb-3">

                        <!-- Search -->
                        <div class="row" wire:ignore>
                            <div class="row p-2 mb-3">
                                <div class="col-md-3">
                                    <div class="form-outline" data-mdb-input-init>
                                        <i class="fab fa-searchengin trailing text-primary"></i>
                                        <input type="search" id="search" wire:model.live="search"
                                            class="form-control form-icon-trailing" aria-describedby="textExample1" />
                                        <label class="form-label" for="search">Search</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Search -->

                        <div class="row">

                            <div class="col-md-12">
                                <!-- Meetings Table -->
                                <div class="table-responsive text-center">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th class="th-sm"><strong>ID</strong></th>
                                                <th class="th-sm"><strong>Title</strong></th>
                                                <th class="th-sm"><strong>Date</strong></th>
                                                <th class="th-sm"><strong>Participants</strong></th>
                                                <th class="th-sm"><strong>Recording</strong></th>
                                                <th class="th-sm"><strong>Username</strong></th>
                                                <th class="th-sm"><strong>ID Number</strong></th>
                                                {{-- <th class="th-sm"><strong>Status</strong></th> --}}
                                                {{-- <th class="th-sm"><strong>Restricted</strong></th> --}}
                                                <th class="th-sm"><strong>Actions</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($meetings as $meeting)
                                                <tr>
                                                    <td>{{ $meeting->id }}</td>
                                                    <td>{{ $meeting->title }}</td>
                                                    <td>{{ $meeting->date }}</td>
                                                    <td>{{ $meeting->participants_number }}</td>
                                                    <td>{{ $meeting->recording_attempts }}</td>
                                                    <td>{{ $meeting->username }}</td>
                                                    <td>{{ $meeting->id_number }}</td>
                                                    {{-- <td>
                                                        @if ($meeting->status === 'Blocked')
                                                            <span class="badge badge-danger">Blocked</span>
                                                        @else
                                                            <span class="badge badge-success">Ignored</span>
                                                        @endif
                                                    </td> --}}
                                                    {{-- <td>
                                                <img src="{{ $meeting->restricted_image }}" alt="Restricted"
                                                    width="50" height="50">
                                            </td> --}}
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a type="button" class="text-danger fa-lg me-2 ms-2"
                                                                wire:click='delete({{ $meeting->id }})' title="Delete">
                                                                <i class="fas fa-trash-can"></i>
                                                            </a>
                                                            <a type="button" class="text-dark fa-lg me-2 ms-2"
                                                                href="#" title="Edit">
                                                                <i class="far fa-pen-to-square"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="fw-bold fs-6">No results found!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Table Pagination -->
                                <div class="d-flex justify-content-between mt-4">

                                    <nav aria-label="...">
                                        <ul class="pagination pagination-circle">
                                            {{ $meetings->withQueryString()->onEachSide(0)->links() }}
                                        </ul>
                                    </nav>

                                    <div class="col-md-1" wire:ignore>
                                        <select class="select" wire:model.live="pagination">
                                            <option value="5">5</option>
                                            <option value="10" selected>10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- Table Pagination -->
                            </div>

                            {{-- <div class="col-md-3 px-4">
                                <img src="{{ asset('assets/admin/images/lidar.jpg') }}" class="rounded"
                                    alt="Townhouses and Skyscrapers" style="max-width: 100%; height: auto;" />
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabs content -->
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Doughnut chart
            const dataDoughnut = {
                type: 'doughnut',
                data: {
                    labels: ['Detected', 'Not Detected'],
                    datasets: [{
                        label: 'Detection Status',
                        data: [60, 40],
                        backgroundColor: [
                            'rgba(205, 233, 185, 0.7)', // Detected
                            'rgba(154, 154, 154, 0.7)' // Not Detected
                        ],
                        borderColor: [
                            'rgba(205, 233, 185, 0.7)', // Detected border
                            'rgba(154, 154, 154, 0.7)' // Not Detected border
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "top"
                        }
                    }
                }
            };

            // Initialize the chart with MDB Chart
            new mdb.Chart(document.getElementById('doughnut-chart'), dataDoughnut);
        });
    </script>
@endpush
