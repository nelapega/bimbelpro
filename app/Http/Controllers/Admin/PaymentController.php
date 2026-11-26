<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    public function index(): Response
    {
        $payments = Payment::with(['invoice', 'student'])
            ->latest()
            ->get();

        $unpaidInvoices = Invoice::with('student')
            ->where('status', 'belum_lunas')
            ->get();

        return Inertia::render('admin/Payments/Index', [
            'payments' => $payments,
            'unpaidInvoices' => $unpaidInvoices,
            'totalPaid' => (float) Payment::where('status', 'berhasil')->sum('amount'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:1000',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:transfer_bank,qris,tunai',
            'notes' => 'nullable|string',
        ]);

        $invoice = Invoice::findOrFail($validated['invoice_id']);
        $paymentNumber = 'PAY-'.date('Ym').'-'.strtoupper(bin2hex(random_bytes(3)));

        Payment::create([
            'invoice_id' => $invoice->id,
            'student_id' => $invoice->student_id,
            'payment_number' => $paymentNumber,
            'amount' => $validated['amount'],
            'payment_date' => $validated['payment_date'],
            'payment_method' => $validated['payment_method'],
            'status' => 'berhasil',
            'notes' => $validated['notes'],
        ]);

        // Perbarui status tagihan menjadi lunas
        $invoice->update(['status' => 'lunas']);

        return back()->with('status', "Pembayaran {$paymentNumber} berhasil dicatat dan tagihan telah dilunasi.");
    }
}
