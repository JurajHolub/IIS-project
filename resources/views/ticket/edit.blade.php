@extends('layouts.app')

@section ('title', 'Tasks')

@section('content')
    <div class="container">
        <div class="card card-body">
            <form method="POST" action="..">
                @csrf
                @method('PATCH')
{{--            ticket state can change only manager --}}
                @if (Auth::user()->isManager())
                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" id="state" name="state">
                            @foreach(\App\Enums\TaskTicketState::MapFrom as $state)
                                <option value="{{ \App\Enums\TaskTicketState::MapTo[$state] }}"
                                        @if($ticket->state === $state)
                                        selected
                                        @endif
                                >{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" autocomplete="off"
                           value="{{ old('title', $ticket->title) }}"
                            @if(!Auth::user()->isAuthorOfTicket($ticket->id)) readonly @endif>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div>Assigned to products:</div>
                    <div class="border p-1 mt-2">
                        @foreach ($product_parts as $product_part)
                            <div class="form-check">
                                <input id="product_part_{{ $product_part->id }}" class="form-check-input" type="checkbox" name="product_part_id[]" value="{{ $product_part->id }}"
                                       {{--                               old checked and and assigned products are checked --}}
                                       @if ((is_array(old('product_part_id')) && in_array($product_part->id, old('product_part_id')))
                                             || $product_part->ticket->contains($ticket))
                                       checked
                                       @endif
                                       {{--                               user can not remove product to which the ticket was assigned, if he is not admin --}}
                                       @if(($product_part->ticket->contains($ticket) && !Auth::user()->isManager())
                                            || !Auth::user()->isAuthorOfTicket($ticket->id))
                                       onclick="return false;" readonly
                                    @endif
                                >
                                <label class="form-check-label" for="product_part_{{ $product_part->id }}">
                                    {{ $product_part->product->title }} - {{ $product_part->title }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('product_part_id')
                    <div class="alert alert-danger">Please select product</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" id="description"
                              @if(!Auth::user()->isAuthorOfTicket($ticket->id)) readonly @endif>{{ old('description', $ticket->description) }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" id="submit" class="btn btn-success">Update ticket</button>
            </form>
        </div>
    </div>
@endsection
