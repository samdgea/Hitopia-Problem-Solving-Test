### Kompleksitas Waktu
**O(n)**: Fungsi `checkBracketBalance` mengiterasi setiap karakter dalam string sekali. Operasi push dan pop pada stack memiliki kompleksitas O(1). Dengan demikian, kompleksitas waktu total adalah O(n), di mana n adalah panjang dari string.

### Kompleksitas Ruang
**O(n)**: Dalam kasus terburuk, stack dapat menyimpan hingga n karakter jika semua karakter dalam string adalah bracket pembuka. Oleh karena itu, kompleksitas ruang adalah O(n).