  @extends('layout.app')
  @section('content')
  <div class="container mx-auto px-4">
      <div class="flex justify-center">
        <x-navbar/>
          <div class="w-full mt-20">
              <div class="bg-white rounded-lg shadow-lg">
                  <div class="p-6">
                      <form action="{{ route('reports.generate') }}" method="GET">
                          <div class="mb-6 flex gap-4">
                              <div class="flex-1">
                                  <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                                  <input type="date" name="start_date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" value="{{ request('start_date', '') }}">
                              </div>
                              <div class="flex-1">
                                  <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                                  <input type="date" name="end_date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" value="{{ request('end_date', '') }}">
                              </div>
                              <div class="flex-none self-end">
                                  <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Generate Report</button>
                              </div>
                          </div>
                      </form>
                      <div class="mt-4" id="myTabContent">
                          <div class="tab-pane fade show active mb-6" id="products">
                              <h2 class="text-lg font-bold mb-3">Products</h2>
                              <div class="overflow-x-auto">
                                  <table class="w-full text-sm divide-y divide-gray-200 border border-gray-200 rounded-lg">
                                      <thead class="bg-gray-50">
                                          <tr>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                          </tr>
                                      </thead>
                                      <tbody class="bg-white divide-y divide-gray-200">
                                          @foreach($products as $product)
                                          <tr class="hover:bg-gray-50">
                                              <td class="px-4 py-2">{{ $product->product_id }}</td>
                                              <td class="px-4 py-2">{{ $product->product_name }}</td>
                                              <td class="px-4 py-2 text-green-600 font-semibold">{{ $product->quantity }}</td>
                                              <td class="px-4 py-2">{{ $product->created_at }}</td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>

                          <div class="tab-pane fade mb-6" id="stockins">
                              <h2 class="text-lg font-bold mb-3">Stock Ins</h2>
                              <div class="overflow-x-auto">
                                  <table class="w-full text-sm divide-y divide-gray-200 border border-gray-200 rounded-lg">
                                      <thead class="bg-gray-50">
                                          <tr>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                          </tr>
                                      </thead>
                                      <tbody class="bg-white divide-y divide-gray-200">
                                          @foreach($stockins as $stockin)
                                          <tr class="hover:bg-gray-50">
                                              <td class="px-4 py-2">{{ $stockin->stockin_id }}</td>
                                              <td class="px-4 py-2">{{ $stockin->product->product_name }}</td>
                                              <td class="px-4 py-2 text-amber-600 font-semibold">{{ $stockin->quantity }}</td>
                                              <td class="px-4 py-2">{{ $stockin->created_at }}</td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>

                          <div class="tab-pane fade" id="stockouts">
                              <h2 class="text-lg font-bold mb-3">Stock Outs</h2>
                              <div class="overflow-x-auto">
                                  <table class="w-full text-sm divide-y divide-gray-200 border border-gray-200 rounded-lg">
                                      <thead class="bg-gray-50">
                                          <tr>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                                              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                          </tr>
                                      </thead>
                                      <tbody class="bg-white divide-y divide-gray-200">
                                          @foreach($stockouts as $stockout)
                                          <tr class="hover:bg-gray-50">
                                              <td class="px-4 py-2">{{ $stockout->stockout_id }}</td>
                                              <td class="px-4 py-2">{{ $stockout->product->product_name }}</td>
                                              <td class="px-4 py-2 text-red-600 font-semibold">{{ $stockout->quantity }}</td>
                                              <td class="px-4 py-2">{{ $stockout->created_at }}</td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection