# test_seller_product.py
import time
from base_test import BaseTest
from selenium.webdriver.common.by import By
from config import BASE_URL, SELLER_EMAIL, SELLER_PASSWORD

class TestTambahProdukSeller(BaseTest):
    def setUp(self):
        super().setUp()
        self.login(SELLER_EMAIL, SELLER_PASSWORD)

    def test_01_buka_halaman_tambah_produk(self):
        self.driver.get(f"{BASE_URL}/seller/products")
        time.sleep(1)

        elem = self.driver.find_element(By.CSS_SELECTOR, "a[href*='/seller/products/create']")
        self.driver.execute_script("arguments[0].click();", elem)

        time.sleep(2)
        self.assertIn('/seller/products/create', self.driver.current_url)

    def test_02_simpan_produk_data_valid(self):
        self.driver.get(f"{BASE_URL}/seller/products/create")
        time.sleep(1)

        self.driver.find_element(By.NAME, 'name').clear()
        self.driver.find_element(By.NAME, 'name').send_keys('Jaket Varsity Thrift')

        self.driver.find_element(By.NAME, 'price').clear()
        self.driver.find_element(By.NAME, 'price').send_keys('150000')

        self.driver.find_element(By.NAME, 'quantity').clear()
        self.driver.find_element(By.NAME, 'quantity').send_keys('50')

        # KEMBALI KE KLIK STANDAR: Agar HTML5 Validation berjalan dan redirect tidak rusak
        self.driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()

        time.sleep(2) # Tunggu loading simpan data
        self.assertIn('/seller/products', self.driver.current_url)

    def test_03_simpan_produk_data_invalid(self):
        self.driver.get(f"{BASE_URL}/seller/products/create")
        time.sleep(1)

        self.driver.find_element(By.NAME, 'name').clear()
        self.driver.find_element(By.NAME, 'name').send_keys('Topi Beanie')

        self.driver.find_element(By.NAME, 'price').clear()
        self.driver.find_element(By.NAME, 'price').send_keys('35000')

        qty_input = self.driver.find_element(By.NAME, 'quantity')
        qty_input.clear()
        qty_input.send_keys('0')

        # KEMBALI KE KLIK STANDAR: Agar Chrome memblokir form yang bernilai 0
        self.driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()

        time.sleep(1)
        # Karena diblokir HTML5, halaman tidak akan ter-refresh dan tetap di form
        self.assertIn('/seller/products/create', self.driver.current_url)

        # Memastikan tooltip error dari browser muncul
        validation_message = qty_input.get_attribute("validationMessage")
        self.assertTrue(len(validation_message) > 0)

    def test_04_batal_tambah_produk(self):
        self.driver.get(f"{BASE_URL}/seller/products/create")
        time.sleep(1)

        elem = self.driver.find_element(By.XPATH, "//a[normalize-space()='Batal']")
        self.driver.execute_script("arguments[0].click();", elem)

        time.sleep(2)
        self.assertIn('/seller/products', self.driver.current_url)
