# AsiaYo

## 資料庫測驗

### 題目一

> 請寫出一條查詢語句 (SQL)，列出在 2023 年 5 月下訂的訂單，使用台幣付款且5月總金額最
多的前 10 筆的旅宿 ID (bnb_id), 旅宿名稱 (bnb_name), 5 月總金額 (may_amount)

```sql
    SELECT
        b.id AS bnb_id,
        b.name AS bnb_name,
        SUM(o.amount) AS may_amount
    FROM
        orders o
    JOIN
        bnbs b ON o.bnb_id = b.id
    WHERE
        o.currency = 'TWD'
        AND o.created_at BETWEEN '2023-05-01' AND '2023-05-31'
    GROUP BY
        b.id, b.name
    HAVING
        may_amount > 0
    ORDER BY
        may_amount DESC
    LIMIT 10;
```

### 題目二

> 在題目一的執行下，我們發現 SQL 執行速度很慢，您會怎麼去優化？請闡述您怎麼判斷與優
化的方式

 單純的 SQL 語法優化會透過 explain 來查看 SQL 的執行計畫，再調整索引的建立來提升查詢效率。

 這步驟優化完後仍無法滿意執行速度，則會考慮對資料庫參數進行調整，例如調整 innodb_buffer_pool_size 等參數。

 最後，若仍無法滿意執行速度，則會考慮對資料庫架構進行調整，例如將資料庫分表、分區等。

 主要調整會是以對系統影響最小的方式進行，並且會透過壓力測試來確認調整後的效果。

## API 實作測驗

 > 請用 Laravel 實作一個提供訂單格式檢查與轉換的 API
 >
 > ● 此應用程式將有一支 endpoint 為 POST /api/orders 的 API 作為輸入點
 >
 > ● 此 API 將以以下固定的 JSON 格式輸入，並請使用 Laravel 的 FormRequest，若未使用 FormRequest 物件，不予給分
 >
 > ● 請按照循序圖實作此 API 的互動類別及其衍生類別。實作之類別需符合物件導向設計
 原則 SOLID 與設計模式。並於該此專案的 README.md 說明您所使用的 SOLID 與
 設計模式分別為何。
 >
 > ● 此 API 需按照以下心智圖之所有情境，處理訂單檢查格式與轉換的功能。
 >
 > ● 以下所有情境皆需附上單元測試，覆蓋成功與失敗之案例。
 >
 > ● 請使用 docker 包裝您的環境。若未使用 docker 或 docker-compose 不予給分
 >
 > ● 實作結果需以 GitHub 呈現。若未使用不予給分

### 使用的 SOLID 與設計模式

專案大致使用了以下 SOLID 原則與設計模式：

- **SOLID**
  - 單一職責原則：Converter 類別只做金額轉換工作; OrderService 類別只做訂單的商業邏輯工作
  - 開放封閉原則: Converter 透過策略模式來實現不同幣別的轉換，不需要修改 Converter 類別就能新增幣別轉換
  - 里氏替換原則: USDConverter 和 TWDConverter 類別的實作都是依照 CurrencyConverter 介面來實作
  - 介面隔離原則: CurrencyConverterInterface 只定義了專門轉換金額的方法

- **設計模式**
  - 策略模式: Converter 類別透過 CurrencyConverterInterface 來實現不同幣別的轉換
