{/* Main content area */}
<main className="flex-1 overflow-y-auto p-6 bg-gray-50">
{/* Page title and actions */}
<div className="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
    <div>
        <h1 className="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
        <p className="text-sm text-gray-500 mt-1">Welcome back, Sarah! Here's what's happening with your store today.</p>
    </div>
    <div className="flex space-x-3 mt-4 md:mt-0">
        <button className="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center">
            <RefreshIcon className="h-4 w-4 mr-2" />
            Refresh
        </button>
        <button className="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center">
            <FilterIcon className="h-4 w-4 mr-2" />
            Filter
        </button>
        <button className="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Add Order
        </button>
    </div>
</div>

{/* Stats cards */}
<div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-6">
    {/* Revenue Card */}
    <div className="bg-white overflow-hidden shadow rounded-lg">
        <div className="p-5">
            <div className="flex items-center">
                <div className="flex-shrink-0 bg-gradient-to-r from-indigo-500 to-indigo-400 rounded-md p-3 shadow-md">
                    <RevenueIcon className="h-6 w-6 text-white" />
                </div>
                <div className="ml-5 w-0 flex-1">
                    <dl>
                        <dt className="text-sm font-medium text-gray-500 truncate">Today's Revenue</dt>
                        <dd className="flex items-baseline">
                            <div className="text-2xl font-semibold text-gray-900">$4,892</div>
                            <div className="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <TrendUpIcon className="self-center flex-shrink-0 h-4 w-4" />
                                <span className="sr-only">Increased by</span>
                                <span>12%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div className="mt-4">
                <div className="h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div className="h-full bg-indigo-500 rounded-full" style={{ width: '72%' }}></div>
                </div>
            </div>
        </div>
    </div>

    {/* Orders Card */}
    <div className="bg-white overflow-hidden shadow rounded-lg">
        <div className="p-5">
            <div className="flex items-center">
                <div className="flex-shrink-0 bg-gradient-to-r from-green-500 to-green-400 rounded-md p-3 shadow-md">
                    <OrdersIcon className="h-6 w-6 text-white" />
                </div>
                <div className="ml-5 w-0 flex-1">
                    <dl>
                        <dt className="text-sm font-medium text-gray-500 truncate">Today's Orders</dt>
                        <dd className="flex items-baseline">
                            <div className="text-2xl font-semibold text-gray-900">48</div>
                            <div className="ml-2 flex items-baseline text-sm font-semibold text-red-600">
                                <TrendDownIcon className="self-center flex-shrink-0 h-4 w-4" />
                                <span className="sr-only">Decreased by</span>
                                <span>5%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div className="mt-4">
                <div className="h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div className="h-full bg-green-500 rounded-full" style={{ width: '65%' }}></div>
                </div>
            </div>
        </div>
    </div>

    {/* Customers Card */}
    <div className="bg-white overflow-hidden shadow rounded-lg">
        <div className="p-5">
            <div className="flex items-center">
                <div className="flex-shrink-0 bg-gradient-to-r from-blue-500 to-blue-400 rounded-md p-3 shadow-md">
                    <CustomersIcon className="h-6 w-6 text-white" />
                </div>
                <div className="ml-5 w-0 flex-1">
                    <dl>
                        <dt className="text-sm font-medium text-gray-500 truncate">New Customers</dt>
                        <dd className="flex items-baseline">
                            <div className="text-2xl font-semibold text-gray-900">12</div>
                            <div className="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <TrendUpIcon className="self-center flex-shrink-0 h-4 w-4" />
                                <span className="sr-only">Increased by</span>
                                <span>8%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div className="mt-4">
                <div className="h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div className="h-full bg-blue-500 rounded-full" style={{ width: '58%' }}></div>
                </div>
            </div>
        </div>
    </div>

    {/* Conversion Card */}
    <div className="bg-white overflow-hidden shadow rounded-lg">
        <div className="p-5">
            <div className="flex items-center">
                <div className="flex-shrink-0 bg-gradient-to-r from-purple-500 to-purple-400 rounded-md p-3 shadow-md">
                    <AnalyticsIcon className="h-6 w-6 text-white" />
                </div>
                <div className="ml-5 w-0 flex-1">
                    <dl>
                        <dt className="text-sm font-medium text-gray-500 truncate">Conversion Rate</dt>
                        <dd className="flex items-baseline">
                            <div className="text-2xl font-semibold text-gray-900">3.2%</div>
                            <div className="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <TrendUpIcon className="self-center flex-shrink-0 h-4 w-4" />
                                <span className="sr-only">Increased by</span>
                                <span>1.1%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div className="mt-4">
                <div className="h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div className="h-full bg-purple-500 rounded-full" style={{ width: '42%' }}></div>
                </div>
            </div>
        </div>
    </div>
</div>

{/* Charts and Order Status Cards */}
<div className="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    {/* Sales Chart */}
    <div className="bg-white shadow rounded-lg p-6 lg:col-span-2">
        <div className="flex items-center justify-between mb-4">
            <h3 className="text-lg font-medium text-gray-900">Sales Overview</h3>
            <div className="flex space-x-2">
                <button className="px-3 py-1 text-xs font-medium rounded-md bg-indigo-100 text-indigo-800">Week</button>
                <button className="px-3 py-1 text-xs font-medium rounded-md hover:bg-gray-100">Month</button>
                <button className="px-3 py-1 text-xs font-medium rounded-md hover:bg-gray-100">Year</button>
            </div>
        </div>
        <div className="h-64 bg-gray-50 rounded-md flex items-center justify-center">
            {/* Placeholder for chart */}
            <div className="text-gray-400">Sales chart will appear here</div>
        </div>
    </div>

    {/* Order Status Cards */}
    <div className="space-y-6">
        <div className="bg-white shadow rounded-lg p-6">
            <h3 className="text-lg font-medium text-gray-900 mb-4">Order Status</h3>
            <div className="space-y-4">
                <div className="flex items-center justify-between">
                    <div className="flex items-center">
                        <div className="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                            <CompletedIcon className="h-5 w-5" />
                        </div>
                        <div>
                            <h4 className="text-sm font-medium text-gray-900">Completed</h4>
                            <p className="text-xs text-gray-500">45 orders</p>
                        </div>
                    </div>
                    <div className="text-sm font-medium text-gray-900">62%</div>
                </div>
                <div className="flex items-center justify-between">
                    <div className="flex items-center">
                        <div className="p-2 rounded-full bg-yellow-100 text-yellow-600 mr-3">
                            <ProcessingIcon className="h-5 w-5" />
                        </div>
                        <div>
                            <h4 className="text-sm font-medium text-gray-900">Processing</h4>
                            <p className="text-xs text-gray-500">25 orders</p>
                        </div>
                    </div>
                    <div className="text-sm font-medium text-gray-900">34%</div>
                </div>
                <div className="flex items-center justify-between">
                    <div className="flex items-center">
                        <div className="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                            <ShippedIcon className="h-5 w-5" />
                        </div>
                        <div>
                            <h4 className="text-sm font-medium text-gray-900">Shipped</h4>
                            <p className="text-xs text-gray-500">15 orders</p>
                        </div>
                    </div>
                    <div className="text-sm font-medium text-gray-900">21%</div>
                </div>
                <div className="flex items-center justify-between">
                    <div className="flex items-center">
                        <div className="p-2 rounded-full bg-red-100 text-red-600 mr-3">
                            <CancelledIcon className="h-5 w-5" />
                        </div>
                        <div>
                            <h4 className="text-sm font-medium text-gray-900">Cancelled</h4>
                            <p className="text-xs text-gray-500">5 orders</p>
                        </div>
                    </div>
                    <div className="text-sm font-medium text-gray-900">7%</div>
                </div>
            </div>
        </div>
    </div>
</div>

{/* Recent orders table */}
<div className="bg-white shadow overflow-hidden rounded-lg">
    <div className="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h3 className="text-lg leading-6 font-medium text-gray-900">Recent Orders</h3>
            <div className="mt-3 sm:mt-0 flex space-x-3">
                <button className="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Export
                </button>
                <a href="#" className="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    View all
                </a>
            </div>
        </div>
    </div>
    <div className="px-4 py-5 sm:p-6">
        <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
                <thead className="bg-gray-50">
                    <tr>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th scope="col" className="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody className="bg-white divide-y divide-gray-200">
                    {recentOrders.map((order) => (
                        <tr key={order.id} className="hover:bg-gray-50">
                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">{order.id}</td>
                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{order.customer}</td>
                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{order.items}</td>
                            <td className="px-6 py-4 whitespace-nowrap">
                                <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusStyles[order.status]}`}>
                                    {statusIcons[order.status]}
                                    {order.status.charAt(0).toUpperCase() + order.status.slice(1)}
                                </span>
                            </td>
                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{order.date}</td>
                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{order.total}</td>
                            <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button className="text-indigo-600 hover:text-indigo-900 mr-3">View</button>
                                <button className="text-gray-400 hover:text-gray-500">
                                    <MoreIcon className="h-5 w-5" />
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    </div>
</div>
</main>