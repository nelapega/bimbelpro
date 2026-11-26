<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InvoiceController extends Controller
{
    public function index(Request $request): Response
    {
        $status = $request->query('status');

        $invoices = Invoice::with('student')
            ->when($status, fn ($q) => $q->where('status', $status))
            ->latest()
            ->get();

        $students = Student::select('id', 'name', 'nis')->where('status', 'aktif')->get();

        return Inertia::render('admin/Invoices/Index', [
            'invoices' => $invoices,
            'students' => $students,
            'currentStatus' => $status ?? 'all',
            'summary' => [
                'total' => (float) Invoice::sum('amount'),
                'unpaid' => (float) Invoice::where('status', 'belum_lunas')->sum('amount'),
                'paid' => (float) Invoice::where('status', 'lunas')->sum('amount'),
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1000',
            'due_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $invoiceNumber = 'INV-'.date('Ym').'-'.strtoupper(bin2hex(random_bytes(3)));

        Invoice::create([
            ...$validated,
            'invoice_number' => $invoiceNumber,
            'status' => 'belum_lunas',
        ]);

        return back()->with('status', "Tagihan baru {$invoiceNumber} berhasil dibuat.");
    }
}
