<div class="container" style="border: 1px solid #000; padding: 20px;">
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
                    <div class="col-md-6">
                        <canvas class="col-sm-12 col-md-10 col-xl-8 mb-4" data-mdb-chart="bar"
                            data-mdb-dataset-label="Traffic"
                            data-mdb-labels="['Monday', 'Tuesday' , 'Wednesday' , 'Thursday' , 'Friday' , 'Saturday' , 'Sunday ']"
                            data-mdb-dataset-data="[2112, 2343, 2545, 3423, 2365, 1985, 987]"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="doughnut-chart"></canvas>
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

                            <div class="col-md-9">
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
                                                <th class="th-sm"><strong>Status</strong></th>
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
                                                    <td>
                                                        @if ($meeting->status === 'Blocked')
                                                            <span class="badge badge-danger">Blocked</span>
                                                        @else
                                                            <span class="badge badge-success">Ignored</span>
                                                        @endif
                                                    </td>
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

                            <div class="col-md-3 px-4">
                                <img src="{{ asset('assets/admin/images/lidar.jpg') }}" class="rounded"
                                    alt="Townhouses and Skyscrapers" style="max-width: 100%; height: auto;" />
                            </div>
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
                    labels: ['January', 'February', 'March', 'April', 'May'],
                    datasets: [{
                        label: 'Traffic',
                        data: [30, 45, 62, 65, 61],
                        backgroundColor: [
                            'rgba(63, 81, 181, 0.5)',
                            'rgba(77, 182, 172, 0.5)',
                            'rgba(66, 133, 244, 0.5)',
                            'rgba(156, 39, 176, 0.5)',
                            'rgba(233, 30, 99, 0.5)',
                        ],
                    }, ],
                },
            };

            new mdb.Chart(document.getElementById('doughnut-chart'), dataDoughnut);

        });
    </script>
@endpush
