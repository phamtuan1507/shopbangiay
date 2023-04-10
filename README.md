# Hướng dẫn sử dụng:

- [Hướng dẫn sử dụng:](#hướng-dẫn-sử-dụng)
  - [Quy định](#quy-định)
  - [Coding convention](#coding-convention)
  - [Cài đặt](#cài-đặt)
    - [Cài đặt project](#cài-đặt-project)
    - [Cài đặt laravel](#cài-đặt-laravel)
    - [Cài đặt NPM package](#cài-đặt-npm-package)
  - [Viết HTML và SCSS](#viết-html-và-scss)
    - [Tạo view](#tạo-view)
    - [Khai báo đường dẫn](#khai-báo-đường-dẫn)
    - [Tạo file scss](#tạo-file-scss)
    - [Biên dịch scss](#biên-dịch-scss)
  - [Quy trình làm việc](#quy-trình-làm-việc)
- [Hướng dẫn review code HTML SCSS:](#hướng-dẫn-review-code-html-scss)
  - [Kiểm tra code HTML](#kiểm-tra-code-html)
    - [Kiểm tra cấu trúc page blade](#kiểm-tra-cấu-trúc-page-blade)
    - [Kiểm tra số lượng page blade](#kiểm-tra-số-lượng-page-blade)
    - [Kiểm tra chuẩn BEM](#kiểm-tra-chuẩn-bem)
  - [Kiểm tra code SCSS](#kiểm-tra-code-scss)
    - [Cấu trúc file scss](#kiểm-tra-code-scss)
    - [Kiểm tra chuẩn BEM](#kie1bb83m-tra-chue1baa9n-bem-1)
    - [Kiểm tra media query](#kiểm-tra-media-query)
    - [Không inline css](#inline-css)
    - [Kiểm tra Mixin](#kiểm-tra-mixin)
    - [Kiểm màu sắc](#kiểm-tra-màu-sắc)
    - [Kiểm tra line-height](#kiểm-tra-line-height)
    - [Kiểm tra border](#kiểm-tra-border)
    - [Kiểm tra Font family](#kiểm-tra-font-family)
    - [Kiểm tra font-size](#kiểm-tra-font-family)
    - [Kiểm tra font-weight](#kiểm-tra-font-weight)
    - [Kiểm tra button-size](#kiểm-tra-button-size)

## Quy định

-   Sử dụng Laravel Blade Template để khai báo các page https://laravel.com/docs/9.x/views
-   Chỉ được code vào file `scss` trong thư mục `resources/sass`, các file `scss` này sẽ được tự động compile thành file css trong thư mục `public/css`. Dùng lệnh `yarn watch` để compile scss tự động thành css. **KHÔNG ĐƯỢC CHỈNH SỬA FILE CSS TRỰC TIẾP**
-   Mỗi page cần tạo 1 file `scss` riêng cho page đó, 1 page không được load nhiều file `scss` của nhiều page (các file `resources/sass/vendor.scss` `resources/sass/global.scss` `resources/sass/header.scss` `resources/sass/footer.scss` sẽ được load vào tất cả các page)
-   HTML/CSS cần được làm theo chuẩn BEM https://getbem.com/
-   Không được cập nhật file `resources/sass/vendor.scss`, trong trường hợp cần cập nhật file này thì cần báo lại để thảo luận
-   Giữ nguyên cấu trúc `resources/sass/global.scss`
-   Tất cả các tham số về màu sắc, font cần được khai báo ở `resources/sass/global.scss` và sử dụng các biến này ở tất cả các nơi cần thiết, cấm hard code các thông số này. **Sử dụng tính năng variable có sẵn của css, KHÔNG dùng variable của scss**
-   Mỗi khi tạo 1 page mới thì cần tạo file `resources/sass/TEN-PAGE.scss` và cập nhật file `webpack.mix.js` để compile file vừa tạo, không đc import tất cả các file `scss` vào chung 1 file vì nó sẽ tạo thành 1 file lớn
-   KHÔNG sử dụng các mixin tự tạo chỉ đc sử dụng mixin có sẵn của bootstrap https://getbootstrap.com/docs/5.0/layout/breakpoints/
-   KHÔNG sử dụng JQuery trừ trường hợp bất khả kháng
-   Sự dụng Media Query của bootstrap https://getbootstrap.com/docs/5.0/layout/breakpoints/
-   Không được dùng file `reset.css` để reset các thuộc tính mặc định của các element
-   Sử dụng đúng grid system của bootstrap https://getbootstrap.com/docs/5.0/layout/grid/
-   **Cấu trúc trong SCSS gần GIỐNG với cấu trúc trong file html**

```html
<!-- Luôn bắt đầu page mới bằng thẻ main.
Đặt class .container cho thẻ main -->
<main class="container">
    <!-- Mỗi 1 row tương ứng với một thẻ section
    Thẻ section gồm 2 class: .row và {tên section}-section để định danh cho section trong page -->
    <section class="row slider-section">
        <div class="col">
            <!-- 1 block trong page là khối html nằm ngay dưới thẻ có chứa class .col -->
            <div class="title">
                <!-- Quy tắc đặt tên các phần tử trong block tuân theo chuẩn BEM -->
                <span class="title__icon"></span>
                <h1 class="title__item"></h1>
            </div>
        </div>
        <div class="col">
            <div class="slider">
                <div class="slider__item">
                    <img src="" alt="" class="slider__img" />
                </div>
                <div class="slider__item">
                    <img src="" alt="" class="slider__img" />
                </div>
                <div class="slider__item">
                    <img src="" alt="" class="slider__img" />
                </div>
                <div class="slider__button">
                    <!-- Không tạo tên class dạng element trong element (slider__button__next).
                    Tham khảo:
                    https://scalablecss.com/bem-nesting-grandchild-elements/,
                    https://en.bem.info/methodology/faq/#why-not-create-elements-of-elements-block__elem1__elem2,
                    https://getbem.com/faq/#css-nested-elements -->
                    <span class="slider__next"></span>
                    <span class="slider__prev"></span>
                </div>
                <div class="slider__dot">
                    <!-- Đặt tên class modifier theo BEM -->
                    <span
                        class="slider__dot-item slider__dot-item--active"
                    ></span>
                    <span class="slider__dot-item"></span>
                </div>
            </div>
        </div>
    </section>

    <section class="row product-section">
        <div class="col-3">
            <div class="product-item">
                <div class="product-item__img">
                    <img src="" alt="" />
                </div>
                <div class="product-item__info">
                    <h3 class="product-item__name"></h3>
                    <p class="product-item__desc"></p>
                    <span class="product-item__price"></span>
                </div>
            </div>
        </div>
    </section>
    ...
</main>
```

```css
// Cấu trúc scss tương đồng với cấu trúc html
// Luôn bắt đầu file scss bằng class bao ngoài cùng của page
.home-page {
    .slider-section {
        .title {
            &__icon {
            }
            &__item {
            }
        }
        .slider {
            &__item {
            }
            &__img {
            }
            &__button {
            }
            &__next {
            }
            &__prev {
            }
            &__dot {
            }
            &__dot-item {
            }
            &__dot-item--active {
            }
        }
    }

    .product-section {
        .product-item {
            &__img {
            }
            &__info {
            }
            &__name {
            }
            &__desc {
            }
            &__price {
            }
        }
    }

    // Responsive mobile first
    // Sử dụng Breakpoint của Bootstrap 5
}
```

## Coding convention

-   Code phải được format.
-   Tên hàm, tên biến, tên class, ... đặt bằng tiếng anh, có ngữ nghĩa (không được đặt tên dạng "class-1", "class-2").
-   Không css inline
-   Viết code scss (và js nếu có) cho từng trang riêng biệt. Không viết chung tất cả vào một file.

## Cài đặt

### Cài đặt project

```
git clone https://github.com/webpress-theme/laravel-mix.git
```

### Cài đặt laravel

Hướng dẫn cài đặt laravel-mix: https://drive.google.com/file/d/1lMDgcGp8TKEa0lgbd8tDbXDwBWMOIQGE/view?usp=sharing

Tham khảo: https://laravel.com/docs/9.x/installation

### Cài đặt NPM package

```
npm install
```

## Viết HTML và SCSS

Để tạo mới một page cần khai báo như sau

### Tạo view

Tạo file `*.blade.php` trong thư mục `resources/views`.
Ví dụ `resources/views/homepage.blade.php`

Khai báo nội dung của file blade như sau:

```
{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layout.master')

{{-- Đặt title cho page --}}
@section('title', 'Trang chủ')

{{-- Đặt file css cho page --}}
@section('file', 'home-page')

{{-- Đặt class cho body --}}
@section('page', 'home-page')

@section('content')
    <main class="main">
        <h1>h1. Bootstrap heading</h1>
    </main>
@endsection

```

**Chú ý: **
Mỗi page sẽ cần có file css riêng, không được load file css của page khác.

Không được thay đổi nội dung của file `resources/sass/vendor.scss`
Mỗi template sẽ có các màu, font-size, font-family theo quy định. các thông số này cần được khai báo trong file `resources/sass/global.scss`. Tất cả những nơi sử dụng các thông số này cần được sử dụng dưới dạng biến (tham khảo https://www.w3schools.com/css/css3_variables.asp)

Mỗi page sẽ load các file css theo thứ tự sau

> Các file này đã được thêm sẵn vào file `master.blade.php` không cần tự thêm vào file \*.blade.php của từng page

```
<link rel="stylesheet" href="./css/vendor.css" />
<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/header.css" />
<link rel="stylesheet" href="./css/footer.css" />
<link rel="stylesheet" href="./css/@yield('file').css">
```

### Khai báo đường dẫn

Khai báo đường dẫn cho page này bằng cách cập nhật file `routes/web.php`.

> Chi tiết hướng dẫn https://laravel.com/docs/9.x/routing

```
Route::get('/', function () {
    return view('homepage');
});
```

### Tạo file scss

-   File `scss` được viết ở thư mục `resources/sass`

-   Cấu hình `webpack.mix.js`

```
mix.sass('resources/sass/filename.scss', 'public/css');
```

### Biên dịch scss

```
npm run watch
```

> Khi thay đổ cấu hình `webpack.mix.js` cần phải chạy lại lệnh biên dịch

## Quy trình làm việc

-   Mỗi mẫu thiết kế được làm trên một nhánh riêng. Tên nhánh được đặt theo tên mẫu thiết kế có trong file xd
    -   Mẫu w02 --> checkout từ master và làm việc trên branch w02
    -   Mẫu w04 --> checkout từ master và làm việc trên branch w04
    -   ...
-   Sau khi hoàn thành công việc, thực hiện tạo PR vào nhánh staging/{tên nhánh}-v01 và add reviewer cho PR đó. Nên chia nhỏ công việc, thực hiện commit nhỏ và tạo PR thường xuyên.
# Hướng dẫn review code HTML SCSS
## Kiểm tra code HTML
> Code HTML lưu ở thư mục `ressources/views`
### Kiểm tra cấu trúc page blade
>   Sử dụng chuẩn file master.blade.php ( KHÔNG ĐƯỢC THIẾU THÔNG TIN )

> File blade.php phải có đủ các dữ liệu như sau:
- Kế thừa từ file master.blade.php
Tiêu đề cho page
- Đường dẫn css: Tên file css phải giống với tên file blade
- Đặt tên class: Tên class body giống mới với tên file blade
- Nội dung home-page được chứa trong @section
- Chỉ sử dụng Js bootstrap với các nghiệp vụ sau: Model, Tab, Collapse,
- Icon sử dụng file .svg tải xuống theo file thiết kế. KHÔNG SỬ DỤNG BẤT KỲ THƯ VIỆN ICON NÀO BÊN NGOÀI ( Hỏi design).
### Kiểm tra số lượng page blade
- Gồm các bước sau:
[đường dẫn repo]/tree/main/resources/views
- Đối chiếu số lượng page với gói thiết kế được nhận
### Kiểm tra chuẩn BEM
- Nhấp tổ hợp phím `Ctrl+shift+p|cmd+shift+p`. Tìm kiếm cụm từ: Fold all
- Kiểm tra tên class từng section
- Kiểm tra class cha trong 1 section
    - Bước 1: Search class cha
    - Bước 2: Rà soát đảm bảo các section con đều chứa tên class cha

| Thành phần  | Block (Khối) | Element (Phần tử) | Modifier (Sửa đổi) |
| ------------- | ------------- | ------------- | ------------- |
| Định nghĩa  | Là thực thể độc lập có ý nghĩa riêng. Tuy các block có thể được lồng vào nhau và tương tác với nhau, nhưng về mặt ngữ nghĩa các block vẫn bình đẳng, không có sự ưu tiên hoặc thứ bậc.  |Là một phần của block và không có ý nghĩa độc lập, hay có thể coi element là phần tử con của block, element được gắn về mặt ngữ nghĩa với block của nó.|Là sửa đổi trên một block hoặc element, được dùng để thay đổi vẻ ngoài, hành vi hoặc trạng thái của block hay element đó.|
| Quy tắc đặt tên  | `<div class="block"></div>` | `<div class="block"> <span     class="block__elem">...</span> </div>`| `.block--color-black { }`|
| Ví dụ  | `header, container, menu, checkbox, input` | `menu item, list item, checkbox caption, header title`| `disabled, highlighted, checked, fixed, size big, color yellow`|
## Kiểm tra code SCSS
### Cấu trúc file scss
Sử dụng các rule trong file global
> Chỉ import partial (một phần) của bootstrap ví dụ: 

```
@import '~bootstrap/scss/bootstrap-utilities';
@import '~bootstrap/scss/bootstrap-grid';
@import '~bootstrap/scss/_forms';
@import '~bootstrap/scss/_buttons';
```
> Cần dùng phần nào thì import phần đó, không nên import thừa những thứ không sử dụng

> Thông thường độ dài SCSS của 1 Page thường khoảng tầm 50 dòng scss, nếu dài hơn có thể bạn chưa tối ưu Bootstrap vào dự án hay thay thế bằng Bootstrap nếu như có thể
### Kiểm tra chuẩn BEM
-   Kiểm tra BEM giống như phần [BEM](#kiểm-tra-chuẩn-bem)
### Kiểm tra media query
-   Không dùng media query, dùng breakpoint của bootstrap
Để kiểm tra thì sử dụng cú pháp sau search: `@media`
### Inline CSS
   >TUYỆT ĐỐI KHÔNG INLINE CSS
-   Để kiểm tra thì sử dụng cú pháp sau search: `style=`
### Kiểm tra Mixin
-   Không sử dụng mixin tự tạo, dùng mixin của bootstrap
-   Để kiểm tra thì sử dụng cú pháp sau search:  `@mixin`
### Kiểm tra màu sắc
-   Không hard code màu sắc
-   Để kiểm tra thì sử dụng cú pháp sau search:  `color:`

### Kiểm tra line-height
-   Không sử dụng `line-height`
-   Để kiểm tra thì sử dụng cú pháp sau search:  `line-height:`
### Kiểm tra border
-   Không hard code, tất cả `border` của thiết kế đều dùng của bootstrap
-   Để kiểm tra thì sử dụng cú pháp sau search:  `border:`
### Kiểm tra Font family
-   Sử dụng 1 `font-family` và được khai ở file `global.scss`
-   Để kiểm tra thì sử dụng cú pháp sau search:  `font-family:`
### Kiểm tra font-size
-   Không hard code, `font-size` đã được quy định trong file `global.scss`
-   Để kiểm tra thì sử dụng cú pháp sau:  `font-size:`
### Kiểm tra font-weight
-   Không hard code, `font-weight` đã được quy định trong file `global.scss`
-   Để kiểm tra thì sử dụng cú pháp sau:  `font-weight:`
### Kiểm tra button-size
-   Không hard code, `button-size` đã được quy định trong file global.scss hoặc sử dụng btn-size của Bootstrap
-   Kiểm tra các class button trong scss của dự án xem đã dung chuẩn các button chưa.
### Kiểm tra height
-   Hạn chế fix cứng.( Trường hợp bất đắc dĩ )
-   Đề kiểm tra sử dụng cú pháp sau search: `height:`
### Kiểm tra weight
-   Hạn chế fix cứng
-   Đề kiểm tra sử dụng cú pháp sau search: `weight:`
### Kiểm tra các thuộc tính reset SCSS
>TUYỆT ĐỐI KHÔNG SỬ DỤNG















