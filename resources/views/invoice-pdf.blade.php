<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture de réservation</title>
    <style>
        /* Styles CSS pour le tableau */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #eaf6ff;
        }

        /* Autres styles CSS pour la mise en page */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .customer-details {
            margin-bottom: 30px;
        }

        .customer-details,
        .reservation-details {
            border: 1px solid #ccc;
            padding: 15px;
        }

        .customer-details h4,
        .reservation-details h4 {
            margin-top: 0;
        }

        .reservation-details table {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <img src="images\61b2fbfe91cb9_logo_150.png" alt="">
        <h1>FACTURE</h1>
    </div>

    <div class="customer-details">
        <h4>Détails du client : </h4>
        <p>Nom du client: {{$invoice->user->fname}} {{$invoice->user->lname}}</p>
        <p>Email: {{$invoice->user->email}}</p>
        <p>Téléphone: {{$invoice->user->phone}}</p>
    </div>

    <div class="reservation-details">
        <h4>Informations sur la réservation :</h4>
        <table>
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Nombre de jours</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$invoice->booking->room->room_name}}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->booking->checkin)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->booking->checkout)->format('d-m-Y') }}</td>
                    <td>{{ (\Carbon\Carbon::parse($invoice->booking->checkin)->diffInDays(\Carbon\Carbon::parse($invoice->booking->checkout)))+1 }}</td>
                    <td>{{$invoice->booking->price}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @if(count($invoiceDetails)>0)
    <div class="reservation-details">
        <h4>Détails de la réservation :</h4>
        <table>
            <thead>
                <tr>
                    <th>Label</th>
                    <th>Purchased On</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoiceDetails as $invoiceDetail)
                <tr>
                    <td>{{$invoiceDetail->libelle}}</td>
                    <td>{{\Carbon\Carbon::parse($invoiceDetail->created_at)->format('d-m-Y')}}</td>
                    <td>{{$invoiceDetail->pu}}</td>
                    <td>{{$invoiceDetail->qte}}</td>
                    <td>{{($invoiceDetail->pu)*($invoiceDetail->qte)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="total-amount">
        <h4>Montant total de la facture :</h4>
        @php
        // Calcul du montant total
        $totalAmount = $invoice->booking->price; // Prix du tableau 1

        foreach($invoiceDetails as $invoiceDetail) {
        $totalAmount += $invoiceDetail->pu * $invoiceDetail->qte; // Somme des 'Amount' du tableau 2
        }
        @endphp

        <p>Le montant total à régler est de : {{$totalAmount}}</p>
    </div>
    <div>
        <div class="payment-details">
            <h4>Modalités de paiement :</h4>
            <p>Merci de régler la facture selon les modalités suivantes :</p>
            <ul>
                <li>Le paiement doit être effectué dans un délai de X jours à compter de la réception de cette facture.</li>
                <li>Mode de paiement : Virement bancaire / Carte de crédit / PayPal, etc.</li>
            </ul>
        </div>
    </div>
</body>

</html>