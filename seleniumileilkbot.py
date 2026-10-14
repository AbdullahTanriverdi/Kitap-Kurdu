from selenium import webdriver
from selenium.webdriver.common.by import By
import time

# Chrome sürücüsünü başlat
driver = webdriver.Chrome()

while True:
    # 1. Localhost üzerindeki üye ol sayfasını aç
    # 'projem' yazan yeri htdocs içindeki kendi klasör adınızla değiştirin
    driver.get("http://localhost/Newprojectforpython11/uyeol.php")
    
    # Sayfanın yüklenmesi için 2 saniye bekle
    time.sleep(2)

    # 2. HTML input alanlarını bul (By.NAME, By.ID veya By.XPATH ile)
    # uyeol.php içindeki <input name="..."> değerlerine göre burayı güncelleyin:
    kullanici_input = driver.find_element(By.NAME, "kullanici_adi")
    eposta_input = driver.find_element(By.NAME, "kullanici_mail")
    sifre_input = driver.find_element(By.NAME, "kullanici_sifre")

    # 3. Kutucuklara veri yaz
    kullanici_input.send_keys("otomatik1023_kullanici")
    eposta_input.send_keys("bot150@test.com")
    sifre_input.send_keys("GuvenliSifre0034315")

    # 4. Formu Gönder / Butona Tıkla
    # Butonun tipi submit ise form üzerinden veya doğrudan butona tıklayarak gönderebilirsiniz
    kayit_butonu = driver.find_element(By.XPATH, "//input[@type='submit']")
    
    # Eğer buton <input type="submit"> ise: driver.find_element(By.XPATH, "//input[@type='submit']")
    
    kayit_butonu.click()

    print("Üye kayıt formu otomatik olarak dolduruldu ve gönderildi!")



    # İşlem sonucunu ekranda görmek için 3 saniye beklet
    time.sleep(3)



    # 5. Üye giriş sayfasına yönlendir
    driver.get("http://localhost/Newprojectforpython11/uyegiris.php")

    time.sleep(2)
    eposta_input = driver.find_element(By.NAME, "kullanici_mail")
    sifre_input = driver.find_element(By.NAME, "kullanici_sifre")
    
    eposta_input.send_keys("bot150@test.com")
    sifre_input.send_keys("GuvenliSifre0034315")
    kayit_butonu = driver.find_element(By.XPATH, "//input[@type='submit']")
    kayit_butonu.click()
    print("Otomatik giriş işlemi tamamlandı!")
    time.sleep(3)  # Giriş yaptıktan sonra 3 saniye bekle   
    driver.quit()  # Tarayıcıyı ve WebDriver oturumunu kapat
