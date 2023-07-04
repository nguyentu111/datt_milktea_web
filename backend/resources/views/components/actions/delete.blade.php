<form action="{{ $url }}" method="POST">
    @csrf
    @method('DELETE')
    <span class="btn-delete-import cursor-pointer hover:bg-red-400 hover:text-white inline-flex items-center rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700">{{ $label }}</span> 
</form>
