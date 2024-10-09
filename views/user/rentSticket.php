<div class="container rentsticket">
  <div class="content-rent">
    <div class="title-sticket">
      Thông tin phiếu mượn
    </div>
    <div class="sticket-list">
      <div class="sticket-item">
        <div class="checkBox">
          <button ></button>
        </div>
        <div class="detail-sticket-item">
          <div class="indexNumber">
            1
          </div>
          <p class="nameBook">
            Tên sách
          </p>
          <div class="numberCount">
            <div class="plus">
              <i class="fa-solid fa-plus"></i>
            </div>
              <p class="count">10</p>
            <div class="sub">
            <i class="fa-solid fa-minus"></i>
            </div>
          </div>
          <div class="deleteBook">
            <i class="fa-solid fa-trash"></i>
          </div>
        </div>
      </div>

     


    </div>

  </div>
</div>

<style>
  .content-rent {
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: #ffffff;
    box-shadow: 0px 0px 20px 10px rgba(0, 0, 0, 0.3);
    width: 800px;
    min-height: 50px;
    margin: 0 auto;
  }

  .title-sticket {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--green-color);
    width: 100%;
    color: #ffffff;
    padding: 15px;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 600;
  }
  .sticket-list{
    flex-direction: column;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 10px;
  }
  .sticket-item{
    display: flex;
    justify-content: center;
    width: 100%;
  }
  .detail-sticket-item{
    display: flex;
    align-items: center;
    border-radius: 10px;
    border: solid 1px #C0C0C0;
    margin-top: 10px;
    min-height: 50px;
    width: 98%;
    background: #ffffff;
  }
  .nameBook{
      margin-left:5px;
    }
  .indexNumber{
    border: solid 1px #C0C0C0;
    text-align: center;
    margin-left: 5px;
    width: 20px;
    border-radius: 50%;
    background-color: #ffffff;
  }
  .numberCount{
    display:flex;
    margin-left: auto;

    align-items: center;
    
  }
  .count{
    border: solid 1px var(--black-cl);
    margin: 0 5px 0 5px ;
    border-radius: 10%;
    padding: 2px;
    background: #ffffff;
  }
  .deleteBook{
    padding-left: 50px;
    margin: 0 20px 0 5px;
  }
</style>