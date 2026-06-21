# test_login.py
from base_test import BaseTest
from selenium.webdriver.common.by import By
from config import BASE_URL, SELLER_EMAIL, SELLER_PASSWORD, BUYER_EMAIL, BUYER_PASSWORD

class TestLogin(BaseTest):
    def test_01_halaman_login_tampil(self):
        self.driver.get(f"{BASE_URL}/login")
        self.assertTrue(self.driver.find_element(By.NAME, 'email').is_displayed())
        self.assertTrue(self.driver.find_element(By.NAME, 'password').is_displayed())

    def test_02_seller_berhasil_login(self):
        self.login(SELLER_EMAIL, SELLER_PASSWORD)
        # Menyesuaikan dengan redirect asli Laravel ke halaman root ("/")
        self.assertEqual(f"{BASE_URL}/", self.driver.current_url)

    def test_03_buyer_berhasil_login(self):
        self.login(BUYER_EMAIL, BUYER_PASSWORD)
        # Menyesuaikan dengan redirect asli Laravel ke halaman root ("/")
        self.assertEqual(f"{BASE_URL}/", self.driver.current_url) 

    def test_04_login_gagal_password_salah(self):
        self.driver.get(f"{BASE_URL}/login")
        self.driver.find_element(By.NAME, 'email').send_keys(SELLER_EMAIL)
        self.driver.find_element(By.NAME, 'password').send_keys('passwordsalah123')
        self.driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
        
        # Mengecek URL mengandung '/login' menggunakan teks parsial
        self.assertIn('/login', self.driver.current_url)