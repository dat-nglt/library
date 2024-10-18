<div class="container contact">
  <div class="getInTouch">
    <p>
      Kết nối với chúng tôi
    </p>
    <form method="post">
            <label for="name">Họ tên:</label>
            <input type="text" id="name" name="name" placeholder="Nhập họ tên" required>

            <label for="tel">Số điện thoại:</label>
            <input type="tel" id="tel" name="tel" placeholder="Nhập số điện thoại" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="@student.ctuet.edu.vn" required>

            <label for="des">Nội dung:</label>
            <textarea id="des" name="des" rows="4" placeholder="Nhập nội dung" required></textarea>

            <button type="submit">Gửi</button>
    </form>
  </div>
  <div class="contactUs">
    <p class="title-contactUs" >
    Liên hệ với chúng tôi
    </p>
    
    <div class="box-contactUs"> 
          <div class="icon-contactus">
            <a href="https://maps.app.goo.gl/f7YyEc6r9kTNobUX9" target="_blank" style="text-decoration: none; color: inherit;">
              <i class="fa-solid fa-location-dot fa-2x"></i>
            </a>
          </div>
          <div class="text-contactus">
              <a href="https://maps.app.goo.gl/f7YyEc6r9kTNobUX9" target="_blank" style="text-decoration: none; color: inherit;">
                  <span>Địa chỉ:</span> 256 Nguyễn Văn Cừ, P.An Hoà, Q.Ninh Kiều, TPCT
              </a>
          </div>
    </div>
    <div class="box-contactUs">
      <div class="icon-contactus">
      <i class="fa-solid fa-phone fa-2x"></i>
      </div>
      <div class="text-contactus">
          <p><span>Số điện thoại:</span>0292 301921</p>
      </div>
    </div>
    <div class="box-contactUs">
      <div class="icon-contactus">
      <i class="fa-solid fa-envelope fa-2x"></i>
      </div>
      <div class="text-contactus">
          <p><span>Email:</span> libctuet@gmail.com</p>
      </div>
    </div>


  </div>
</div>
<scrip>

</scrip>
<style>
  /* 2101364
  dat20April@ */
  .contact{
    display: flex;
    justify-content: center;
    margin: 0 auto;
    padding-top:10px;
  }
  .getInTouch {
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-radius: 10px 0 0 10px;
    p{
      color: #000000;
      padding: 15px;
      font-size: 24px;
      font-weight: 600;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 8px;
      width: 480px;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 8px;
      label {
        font-size: 14px;
        margin-bottom: 5px;
        color: #333;
      }
      input, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;

        &:focus {
          border-color: #66afe9;
          outline: none;
          box-shadow: 0 0 5px rgba(102, 175, 233, 0.5);
        }
      }

      textarea {
        resize: vertical;
      }

      button {
        background-color: var(--green-cl);
        width: 40%;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;

        &:hover {
          background-color: var(--green-black-cl);
        }
      }
    }
  }
  .contactUs{
    background-color: var(--green-cl);
    color: #ffffff;
    border-radius: 10px 10px 10px 10px;
    margin-top: -20px;
    margin-bottom: -20px;

    .title-contactUs {
      margin-top: 5%;
      padding: 15px;
      font-size: 24px;
      font-weight: 600;
    }
    .box-contactUs {
    
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 15px;
    .icon-contactus {
        margin-left:10px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
    }

    .text-contactus { 
        margin-left: 15px;
        width: 300px;
        
        p {
          font-size: 16px;
          margin: 0;
          span{
            font-weight: 600;
          }
        }
    }
}
  }
</style>