@extends('base')

@section('main-content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Invoices</h2>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th class="text-center">Client</th>
                                    <th class="text-center">Booking Ref</th>
                                    <th class="text-center">Room Name</th>
                                    <th class="text-center">Check In</th>
                                    <th class="text-center">Check Out</th>
                                    <th class="text-center">Days</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Created On</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($invoices)>0)
                                @foreach($invoices as $invoice)
                                <tr>
                                    <td class="text-center">
                                        @if($invoice->user)
                                        {{$invoice->user->fname}} {{$invoice->user->lname}}
                                        @else
                                        User Deleted
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($invoice->booking)
                                        {{$invoice->booking->id}}
                                        @else
                                        Booking Deleted
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($invoice->booking && $invoice->booking->room)
                                        {{$invoice->booking->room->room_name}}
                                        @else
                                        Room Deleted
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($invoice->booking)
                                        {{ \Carbon\Carbon::parse($invoice->booking->checkin)->format('d-m-Y') }}
                                        @else
                                        Booking Deleted
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($invoice->booking)
                                        {{ \Carbon\Carbon::parse($invoice->booking->checkout)->format('d-m-Y') }}
                                        @else
                                        Booking Deleted
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($invoice->booking)
                                        {{ (\Carbon\Carbon::parse($invoice->booking->checkin)->diffInDays(\Carbon\Carbon::parse($invoice->booking->checkout)))+1 }}
                                        @else
                                        Booking Deleted
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($invoice->booking)
                                        {{$invoice->booking->price}}
                                        @else
                                        Booking Deleted
                                        @endif
                                    </td>
                                    <td class="text-center">{{$invoice->created_at}}</td>
                                    <td class="text-center">{{$invoice->inv_status}}</td>
                                    @if($invoice->inv_status=='Pending')
                                    <td class="text-center">
                                        <a href="{{route('updatePaidInvoice',['id'=>$invoice->id])}}" class="btn btn-info">Payer</a> |
                                        <button class=" btn btn-success editBtn" data-invoice-id="{{$invoice->id}}">Edit</button>
                                    </td>
                                    @endif
                                    @if($invoice->inv_status=='Paid')
                                    <td class="text-center"><a href="{{route('updateClosedInvoice',['id'=>$invoice->id])}}" class="btn btn-success">Print</a></td>
                                    @endif
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <h4>Rien pour le moment</h4>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la facture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="invoiceForm">
                    <div class="form-group">
                        <label for="libelle">Label:</label>
                        <input type="text" class="form-control" id="libelle" name="libelle">
                    </div>
                    <div class="form-group">
                        <label for="pu">Unit Price:</label>
                        <input type="number" class="form-control" id="pu" name="pu">
                    </div>
                    <div class="form-group">
                        <label for="qte">Quantity:</label>
                        <input type="number" class="form-control" id="qte" name="qte">
                    </div>
                    <button type="submit" class="btn btn-primary" id="addInvoiceBtn">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.editBtn').on('click', function() {
            $('#editModal').modal('show');
        });

        $('#invoiceForm').submit(function(event) {
            event.preventDefault();

            var libelle = $('#libelle').val();
            var pu = $('#pu').val();
            var qte = $('#qte').val();
            var invoiceId = $('.editBtn').data('invoice-id');

            $.ajax({
                type: 'POST',
                url: '/invoices/add',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'libelle': libelle,
                    'pu': pu,
                    'qte': qte,
                    'invoice_id': invoiceId
                },
                success: function(response) {
                    console.log(response);
                    $('#libelle').val('');
                    $('#pu').val('');
                    $('#qte').val('');
                    $('#editModal').modal('hide');
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: response.message
                    });
                },
                error: function(error) {
                    // Gérez les erreurs si nécessaire
                    console.log(error);
                }
            });

        });
    });
</script>

@endsection