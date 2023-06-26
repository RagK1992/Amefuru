// 登録確認ダイアログの表示
  function registerConfirm() {
    if (confirm("登録しますか？")) {
      $('#register-form').submit();
    }
  };

    // ハンバーガーメニューのクリックイベント
$('.hamburger-icon').click(function() {
  var mobileMenu = $('.mobile-menu');
  mobileMenu.toggle();
});

$(document).ready(function() {
  $('#filter-form').on('submit', function(e) {
    e.preventDefault(); // フォームのデフォルトの送信を防止

    var url = $(this).attr('action');
    var method = $(this).attr('method');
    var formData = $(this).serialize();

    $.ajax({
      url: url,
      type: method,
      data: formData,
      success: function(response) {
        // レスポンスを処理し、結果を表示する
        var newContent = $(response).find('#tab-content').html(); // レスポンスから新しいコンテンツを取得
        $('#tab-content').html(newContent); // #tab-contentの中身を置き換え
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  });

  // タブがクリックされた時の処理
  $('.tab').click(function() {
    var tabId = $(this).data('tab');
    var tabContents = $('.tabcontent');
    var areaSelectbox = $('.area-serch');

    // クリックされたタブに対応するコンテンツの表示制御
    tabContents.each(function() {
      if (this.id === tabId + '-tabcontent') {
        // クリックされたタブに対応するコンテンツが既に表示されている場合は何もしない
        if ($(this).hasClass('tab-active')) {
          return;
        }
        $(this).addClass('tab-active');
      } else {
        $(this).removeClass('tab-active');
      }
    });

    // クリックされたタブのスタイルを変更する
    $('.tab').each(function() {
      if ($(this).data('tab') === tabId) {
        $(this).addClass('current-tab');
        if (tabId === 'articles') {
          areaSelectbox.addClass('hidden');
        } else {
          areaSelectbox.removeClass('hidden');
        }
      } else {
        $(this).removeClass('current-tab');
      }
    });

    // コンテンツの高さを再計算する
    setTabContentHeight();
  });

  // ページロード時のタブの表示切り替え
  $(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const tag = urlParams.get('tag');
    var areaSelectbox = $('.area-serch');

    if (tag === 'articles') {
      $('#coupons-tabcontent').removeClass('tab-active');
      $('#articles-tabcontent').addClass('tab-active');
      $('.tab').each(function() {
        if ($(this).data('tab') === 'articles') {
          $(this).addClass('current-tab');
          areaSelectbox.addClass('hidden');
        } else {
          $(this).removeClass('current-tab');
        }
      });
    } else {
      $('#coupons-tabcontent').addClass('tab-active');
      $('#articles-tabcontent').removeClass('tab-active');
      $('.tab').each(function() {
        if ($(this).data('tab') === 'coupons') {
          $(this).addClass('current-tab');
        } else {
          $(this).removeClass('current-tab');
        }
      });

      // コンテンツの高さを再計算する	
      setTabContentHeight();
    }

    var articlesTab = $('.tab[data-tab="articles"]');
    var areaSelectbox = $('.area-serch');

    if (articlesTab.hasClass('current-tab')) {
      areaSelectbox.addClass('hidden');
    } else {
      areaSelectbox.removeClass('hidden');
    }

    // コンテンツの高さを再計算する
    setTabContentHeight();
  });

  // コンテンツの高さを計算して設定する
  function setTabContentHeight() {
    var tabContent = $('#tab-content');
    var tabContents = $('.tabcontent');
    var maxHeight = 0;

    tabContents.each(function() {
      $(this).css('height', 'auto');
      var height = $(this).outerHeight();
      if (height > maxHeight) {
        maxHeight = height;
      }
    });

    tabContents.each(function() {
      $(this).css('height', maxHeight + 'px');
    });

    tabContent.css('height', maxHeight + 'px');
  }

  // ページロード時に一度高さを設定する
  $(window).on('load', function() {
    setTabContentHeight();
  });

  // ウィンドウのリサイズ時に高さを再計算する
  $(window).on('resize', function() {
    setTabContentHeight();
  });

});