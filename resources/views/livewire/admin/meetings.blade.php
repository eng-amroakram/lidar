<div class="container">
    <div class="p-2 mb-4">

        <!-- Meeting Page Title -->
        <div class="text-center p-3">
            <h2>Meeting Page</h2>
        </div>

        <!-- Start and Join Meeting Buttons -->
        <div class="text-center mb-4">
            <button class="btn btn-success me-2">Start a Meeting</button>
            <button class="btn btn-outline-success">Join a Meeting</button>
        </div>

        <!-- Past Meetings Title -->
        <div class="text-center mb-3">
            <h4>Past Meetings</h4>
        </div>

        <!-- Search Input for Past Meetings -->
        <div class="form-outline" data-mdb-input-init>
            <i class="fab fa-searchengin trailing text-primary"></i>
            <input type="search" id="search" wire:model.live="search" class="form-control form-icon-trailing"
                aria-describedby="textExample1" />
            <label class="form-label" for="search">Search</label>
        </div>

    </div>
</div>
