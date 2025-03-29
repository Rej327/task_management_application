<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden opacity-0 transition-opacity duration-300">
  <div class="bg-white p-6 rounded shadow-lg w-96 transform scale-95 transition-transform duration-300">
      <h2 class="text-lg font-bold">Confirm Deletion</h2>
      <p class="text-sm text-gray-600">Are you sure you want to delete this task? This action cannot be undone.</p>
      <div class="mt-4 flex justify-end space-x-2">
          <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
          <form id="deleteForm" method="POST">
              @csrf @method('DELETE')
              <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
          </form>
      </div>
  </div>
</div>
