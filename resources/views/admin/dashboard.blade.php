@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <!-- Welcome Card -->
    <div class="mb-6 bg-gradient-to-r from-purple-500 to-indigo-600 text-white p-6 rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="mt-2 text-lg">Here's a quick overview of your admin panel.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow p-4 flex flex-col justify-between hover:shadow-lg transition-shadow">
            <div>
                <h2 class="text-gray-500 font-semibold">Total Sliders</h2>
                <p class="text-2xl font-bold text-indigo-600 mt-2">12</p>
            </div>
            <div class="mt-3">
                <span class="text-green-500 font-medium">+5% </span> since last month
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 flex flex-col justify-between hover:shadow-lg transition-shadow">
            <div>
                <h2 class="text-gray-500 font-semibold">Active Users</h2>
                <p class="text-2xl font-bold text-purple-600 mt-2">250</p>
            </div>
            <div class="mt-3">
                <span class="text-green-500 font-medium">+12% </span> since last week
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 flex flex-col justify-between hover:shadow-lg transition-shadow">
            <div>
                <h2 class="text-gray-500 font-semibold">New Messages</h2>
                <p class="text-2xl font-bold text-pink-600 mt-2">8</p>
            </div>
            <div class="mt-3">
                <span class="text-red-500 font-medium">-2% </span> since yesterday
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 flex flex-col justify-between hover:shadow-lg transition-shadow">
            <div>
                <h2 class="text-gray-500 font-semibold">Pending Approvals</h2>
                <p class="text-2xl font-bold text-green-600 mt-2">4</p>
            </div>
            <div class="mt-3">
                <span class="text-yellow-500 font-medium">+1 </span> new today
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Recent Activity</h2>
        <ul class="divide-y divide-gray-200">
            <li class="py-3 flex justify-between items-center">
                <span class="text-gray-600">John Doe added a new slider</span>
                <span class="text-sm text-gray-400">2 hours ago</span>
            </li>
            <li class="py-3 flex justify-between items-center">
                <span class="text-gray-600">Admin updated user permissions</span>
                <span class="text-sm text-gray-400">5 hours ago</span>
            </li>
            <li class="py-3 flex justify-between items-center">
                <span class="text-gray-600">New user registered</span>
                <span class="text-sm text-gray-400">1 day ago</span>
            </li>
        </ul>
    </div>
</div>
@endsection
