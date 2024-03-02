// Xử lý sự kiện khi người dùng nhập vào thanh tìm kiếm và nhấn Enter
document.getElementById("searchBar").addEventListener("keydown", function(event) {
  if (event.key === "Enter") {
    var query = event.target.value;
    // Ứng với mã nút Enter, bạn có thể thực hiện tìm kiếm hoặc thao tác khác
    alert("Bạn đã gõ: " + query);
    event.preventDefault();
  }
});