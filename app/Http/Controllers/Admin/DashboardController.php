<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for dashboard
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        
        // Recent orders
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        
        // Low stock products
        $lowStockProducts = Product::where('stock', '<', 10)->take(5)->get();
        
        // Recent users
        $recentUsers = User::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalProducts', 'totalUsers', 'totalOrders', 
            'pendingOrders', 'totalRevenue', 'recentOrders',
            'lowStockProducts', 'recentUsers'
        ));
    }
}