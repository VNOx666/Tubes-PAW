# test_buyer.py
from base_test import BaseTest
from selenium.webdriver.common.by import By
from config import BASE_URL, BUYER_EMAIL, BUYER_PASSWORD

class TestBuyerAkses(BaseTest):
    def setUp(self):
        super().setUp()
        # Login sebagai buyer sebelum menjalankan setiap skenario
        self.login(BUYER_EMAIL, BUYER_PASSWORD)

    def test_01_tidak_lihat_tombol_tambah_produk(self):
        self.driver.get(f"{BASE_URL}/home")
        tombol_tambah = self.driver.find_elements(By.LINK_TEXT, 'Tambah Produk Baru')
        self.assertEqual(len(tombol_tambah), 0)

    def test_02_tidak_bisa_paksa_akses_halaman_create_seller(self):
        self.driver.get(f"{BASE_URL}/seller/products/create")

        self.assertIn('403', self.driver.page_source)
