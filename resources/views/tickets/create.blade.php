@extends('layouts.app')

@section('content')


    <div class="container-fluid py-4">

        {{-- Page Header --}}
        <div class="mb-4">
            <h2 class="fw-bold mb-1">Submit a Ticket</h2>
            <p class="text-muted mb-0">
                Create a new support request. Our team will assist you shortly.
            </p>
        </div>

        <div class="row">
            <div class="col-lg-8 col-xl-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-ticket-perforated me-2"></i>
                            Ticket Information
                        </h5>
                    </div>

                    <div class="card-body p-4">

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/tickets/store" method="POST">
                            @csrf

                            {{-- Title --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Ticket Title <span class="text-danger">*</span>
                                </label>

                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                    placeholder="e.g. Unable to access my account" value="{{ old('title') }}">

                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Category & Priority --}}
                            <div class="row mb-4">

                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label fw-semibold">
                                        Category <span class="text-danger">*</span>
                                    </label>

                                    <select name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Priority <span class="text-danger">*</span>
                                    </label>

                                    <select name="priority" class="form-select @error('priority') is-invalid @enderror">
                                        <option value="Low" {{ old('priority', 'Low') == 'Low' ? 'selected' : '' }}>
                                            Low
                                        </option>
                                        <option value="Medium" {{ old('priority') == 'Medium' ? 'selected' : '' }}>
                                            Medium
                                        </option>
                                        <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>
                                            High
                                        </option>
                                        <option value="Urgent" {{ old('priority') == 'Urgent' ? 'selected' : '' }}>
                                            Urgent
                                        </option>
                                    </select>

                                    @error('priority')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            {{-- Description --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Description <span class="text-danger">*</span>
                                </label>

                                <textarea name="description" rows="6"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Describe your issue in detail...">{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <small class="text-muted">
                                    Please provide enough information to help us understand your issue.
                                </small>
                            </div>

                            <hr>

                            {{-- Buttons --}}
                            <div class="d-flex justify-content-end gap-2">
                                <a href="/tickets" class="btn btn-light border">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-send me-2"></i>
                                    Submit Ticket
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            {{-- Information Panel --}}
            <div class="col-lg-4 col-xl-5 mt-4 mt-lg-0">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-info-circle text-primary fs-4 me-2"></i>
                            <h5 class="fw-semibold mb-0">Before submitting</h5>
                        </div>

                        <p class="text-muted">
                            Help us resolve your issue faster by following these tips:
                        </p>

                        <div class="d-flex mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                            <div>
                                <strong>Use a clear title</strong>
                                <p class="text-muted small mb-0">
                                    Briefly describe the problem.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                            <div>
                                <strong>Select the right category</strong>
                                <p class="text-muted small mb-0">
                                    This helps direct your ticket to the right team.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                            <div>
                                <strong>Explain the issue</strong>
                                <p class="text-muted small mb-0">
                                    Include relevant details and any error messages.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection