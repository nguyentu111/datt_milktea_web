export default function Search() {
  return (
    <div className="border-[1px] rounded">
      <input
        placeholder="Search for drinks"
        className="m-0 p-0 w-[400px] h-full pl-2"
      />
      <button className="h-full form-btn rounded">search</button>
    </div>
  );
}
