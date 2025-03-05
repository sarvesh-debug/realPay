@extends('user/include.layout')

@section('content')

<div class="container py-4">
    @include('user.dmtinstantpay.navbar')
    <div class="row justify-content-center mt-3">
        <!-- Remitter Profile Section -->
        <div class="col-md-6 ">
            <div class="card shadow-lg border-0">
                <div class="card-header py-3">
                    <h4 class="card-heading mb-0"><i class="fas fa-user-circle me-2"></i>Remitter Profile</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('dmt.remitter-profile_chk') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="mobile" class="form-label">Mobile No</label>
                            <input type="text" class="form-control"  id="mobile" name="mobileNumber" placeholder="Enter mobile number" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle me-2"></i>Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Latest Transactions Section -->
        @if($latestTransactions && count($latestTransactions) > 0)
            <div class="col-md-6">
                <div class="card shadow-lg border-0 h-100">
                    <div class="card-header bg-gradient-success text-white text-center py-3">
                        <h5 class="card-heading"><i class="fas fa-receipt me-2"></i>Latest Transactions</h5>
                    </div>
                    <div class="card-body p-4">
                        @foreach($latestTransactions as $transaction)
                            <div class="transaction-item d-flex justify-content-between align-items-center py-3 border-bottom position-relative">
                                <div class="transaction-details">
                                    <strong class="text-primary">₹{{ $transaction['amount'] ?? 'N/A' }}</strong>
                                    <div class="small text-muted">{{ $transaction['date'] ?? 'N/A' }}</div>
                                </div>
                                <span 
                                    class="badge bg-{{ $transaction['status'] === 'success' ? 'success' : ($transaction['status'] === 'pending' ? 'warning' : 'danger') }} px-3 py-2">
                                    {{ ucfirst($transaction['status']) }}
                                </span>
                                <div class="transaction-icon position-absolute end-0 top-50 translate-middle-y me-3">
                                    <!-- <i class="fas fa-{{ $transaction['status'] === 'success' ? 'check-circle' : ($transaction['status'] === 'pending' ? 'hourglass-half' : 'times-circle') }} text-{{ $transaction['status'] === 'success' ? 'success' : ($transaction['status'] === 'pending' ? 'warning' : 'danger') }} fa-lg"></i> -->
                                    <i class="fas {{ $transaction['status'] === 'pending' ? 'fa-hourglass-half' : '' }} 
                                    text-{{ $transaction['status'] === 'success' ? 'success' : ($transaction['status'] === 'pending' ? 'warning' : 'danger') }} fa-lg">
                                    </i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
