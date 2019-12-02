@extends ('layouts.app')

@section ('title', 'Tasks')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-3 mb-3 mb-lg-0">
                <form method="GET" action="tasks">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Sort:</span>
                        </div>
                        <select class="form-control" id="sel1" name="sort" onchange="this.form.submit()">
                            <option @if ( $sort == "recently_updated" ) selected @endif>Recently updated</option>
                            <option @if ( $sort == "newest" ) selected @endif>Newest</option>
                            <option @if ( $sort == "oldest" ) selected @endif>Oldest</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 offset-lg-7">
                <a class="btn btn-success btn-block" href="tasks/create">New task</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="list-group">
                    @forelse($tasks as $task)
                        <div class="list-group-item my-link" id="task-{{ $task->id }}">
                            <strong><a href="tasks/{{ $task->id }}">{{ $task->title }}</a></strong>
                            <p class="info mb-0 mt-3 p-0">
                                Opened by <a href="tasks#">{{ $task->manager->login }}</a>
                                {{ $task->updated_at->diffForHumans() }}
                            </p>
                            <p class="info mb-0 mt-3 p-0">
                                Assigned to
                                @forelse($task->employees as $employee)
                                    <a href="tasks#">{{ $employee->login }}</a>
                                @empty
                                    no one...
                                @endforelse
                            </p>
                        </div>
                    @empty
                        <p>No tasks</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
