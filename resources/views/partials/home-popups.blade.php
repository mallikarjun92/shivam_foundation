<!-- Upcoming Events Modal -->
<div class="modal fade" id="eventsModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">📅 Upcoming Events</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body text-center">
        <p class="mb-4">
          At Vishvam Foundation, meaningful initiatives are always in motion.
          Stay connected to be part of our upcoming programs, drives, and community activities.
        </p>

        @if(isset($uevents) && count($uevents) > 0)
          <ul class="list-group text-left mb-4">
            @foreach($uevents as $event)
              <li class="list-group-item d-flex flex-wrap justify-content" style="gap: 5px !important;">
                <div>
                    <img src="{{ $event['image'] }}" alt="" style="width: 55px; height: 55px; object-fit:cover;">
                </div>
                <div>
                    <a href="{{ route('events.show', $event['id']) }}" target="_blank" rel="noopener noreferrer">
                        <strong>{{ $event['title'] }}</strong>
                    </a><br>
                    <small class="text-muted">
                    {{ $event['date'] }}
                    </small>
                </div>
              </li>
            @endforeach
          </ul>
        @else
          <div class="alert alert-light border">
            <strong>New events are coming soon!</strong><br>
            Follow us and check back regularly to stay updated on our upcoming initiatives.
          </div>
        @endif
      </div>

      <div class="modal-footer justify-content-center">
        <a href="{{ route('events.list') }}" class="btn btn-success btn-lg">
          View All Events
        </a>
      </div>

    </div>
  </div>
</div>

<!-- Program Enrollment Modal -->
<div class="modal fade" id="programModal" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">🎓 Join Our Programs</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body text-center">
        <p>
          Our programs are designed to empower communities and transform lives.
        </p>

        <a href="{{ route('programs.index') }}" class="btn btn-success btn-lg mt-3">
            Explore Programs
        </a>
      </div>

    </div>
  </div>
</div>
