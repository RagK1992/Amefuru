-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2023 年 6 月 26 日 17:43
-- サーバのバージョン： 5.7.39
-- PHP のバージョン: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `amefuru`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL COMMENT '管理者ID',
  `admin_name` varchar(30) NOT NULL COMMENT '管理者名',
  `password` varchar(100) NOT NULL COMMENT 'パスワード',
  `email` varchar(100) NOT NULL COMMENT 'メールアドレス'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$vyFsz8nLxUcfqm4khfpzYeKce49vJ9wqGBTSGce/thBOyKFuLKw66', 'admin@gmail.com'),
(2, 'testadmin', '$2y$10$pkvys924ky0n9n9Pjr81Zuis.asdpHXv4ZA7.LxIzN5KOZ7EUoBhi', 'testadmin@test.com');

-- --------------------------------------------------------

--
-- テーブルの構造 `areas`
--

CREATE TABLE `areas` (
  `area_id` int(11) NOT NULL COMMENT '地域ID',
  `prefecture` varchar(10) NOT NULL COMMENT '都道府県名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `areas`
--

INSERT INTO `areas` (`area_id`, `prefecture`) VALUES
(1, '北海道'),
(2, '青森県'),
(3, '岩手県'),
(4, '宮城県'),
(5, '秋田県'),
(6, '山形県'),
(7, '福島県'),
(8, '茨城県'),
(9, '栃木県'),
(10, '群馬県'),
(11, '埼玉県'),
(12, '千葉県'),
(13, '東京都'),
(14, '神奈川県'),
(15, '新潟県'),
(16, '富山県'),
(17, '石川県'),
(18, '福井県'),
(19, '山梨県'),
(20, '長野県'),
(21, '岐阜県'),
(22, '静岡県'),
(23, '愛知県'),
(24, '三重県'),
(25, '滋賀県'),
(26, '京都府'),
(27, '大阪府'),
(28, '兵庫県'),
(29, '奈良県'),
(30, '和歌山県'),
(31, '鳥取県'),
(32, '島根県'),
(33, '岡山県'),
(34, '広島県'),
(35, '山口県'),
(36, '徳島県'),
(37, '香川県'),
(38, '愛媛県'),
(39, '高知県'),
(40, '福岡県'),
(41, '佐賀県'),
(42, '長崎県'),
(43, '熊本県'),
(44, '大分県'),
(45, '宮崎県'),
(46, '鹿児島県'),
(47, '沖縄県');

-- --------------------------------------------------------

--
-- テーブルの構造 `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL COMMENT '記事ID',
  `admin_id` int(11) NOT NULL COMMENT '管理者ID',
  `article_title` varchar(50) NOT NULL COMMENT '記事タイトル',
  `article_description` text NOT NULL COMMENT '記事内容',
  `article_thumbnail` blob NOT NULL COMMENT 'サムネイル画像',
  `created_at` date NOT NULL COMMENT '作成日',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '削除',
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `articles`
--

INSERT INTO `articles` (`article_id`, `admin_id`, `article_title`, `article_description`, `article_thumbnail`, `created_at`, `deleted`, `updated_at`) VALUES
(1, 1, '雨の日にぴったりのアクティビティ！名古屋港水族館で海の世界を満喫', '名古屋港水族館は、雨の日でも楽しめる魅力的な施設です。この水族館は、名古屋市に位置し、魅力的な展示物や活気にあふれた雰囲気で知られています。<br />\r\n<br />\r\nまず第一に、名古屋港水族館は屋内施設であるため、雨天の影響を受けることなく訪れることができます。屋内なので、天候に左右されずに展示物やイベントをゆっくり楽しむことができます。雨の日にも快適な空間で海の生き物たちを観察することができます。<br />\r\n<br />\r\nさらに、名古屋港水族館は幅広い展示物を提供しています。海洋生物の多様性を体験できるだけでなく、迫力あるショーやパフォーマンスも楽しめます。人気のある展示物には、イルカやシャチのショーがあります。雨の日でも、これらのショーを見ることができ、興奮と感動を味わうことができます。<br />\r\n<br />\r\nさらに、名古屋港水族館ではさまざまな体験プログラムも提供されています。例えば、エイやサメとのふれあい体験や、イルカとのふれあいショーなど、生き物たちとの触れ合いを通じて特別な思い出を作ることができます。雨の日には、これらの体験プログラムが特に人気であり、家族や友人と楽しむことができます。<br />\r\n<br />\r\nさらに、名古屋港水族館にはレストランやカフェも充実しています。雨の日には、美味しい食事や飲み物を楽しみながら、ゆっくりと時間を過ごすことができます。屋内の飲食エリアでは、海の幸を味わうことができるだけでなく、くつろいだ雰囲気の中でリフレッシュすることもできます。<br />\r\n<br />\r\n最後に、名古屋港水族館の周辺には他の観光スポットも多くあります。雨の日に水族館を訪れた後は、名古屋港のショッピングモールやレストラン、美術館などを巡ることができます。名古屋港周辺は観光地としても人気があり、雨の日でも楽しい時間を過ごすことができます。<br />\r\n<br />\r\n名古屋港水族館は、雨の日でも充実した体験を提供するために様々な工夫がなされています。屋内での展示やショー、体験プログラム、飲食エリアなど、多彩なアクティビティが用意されています。雨の日には特に人気があり、家族や友人と一緒に楽しむことができます。<br />\r\n<br />\r\n名古屋港水族館を訪れる際は、事前にウェブサイトや公式アプリをチェックして営業時間やイベント情報を確認することをおすすめします。また、混雑状況を避けるために早めの訪問や事前のチケット予約もお忘れなく。<br />\r\n<br />\r\n雨の日でも楽しめる名古屋港水族館は、海の生き物たちとのふれあいや感動的なショー、美味しい飲食体験など、魅力が満載です。天候に左右されずに海の世界を楽しむことができるので、ぜひ雨の日にも訪れてみてください。素晴らしい思い出が待っています。<br />\r\n<br />\r\n名古屋港水族館基本情報<br />\r\n公式サイト：http://www.nagoyaaqua.jp/<br />\r\n住所：〒455-0033　 愛知県名古屋市港区港町1番3号<br />\r\n電話：052-654-7080<br />\r\n営業時間：9:30～17:30（通常時）<br />\r\n9:30～20:00（夏休み期間中）', 0x7075626c69632f696d672f363439393339333631376261395f363439393338633965326339395f6e61676f79616b6f752e6a7067, '2023-06-21', 0, '2023-06-26'),
(2, 1, '全力クライミング！ボルダリング施設の魅力を紹介', 'ボルダリングは、雨の日でも楽しめる室内スポーツとして人気を集めています。ボルダリングはクライミングの一種であり、特殊な壁に手や足を使って課題を解決するスポーツです。以下では、雨の日でも楽しめるボルダリング施設の魅力と利点についてご紹介します。<br />\r\n<br />\r\nボルダリング施設は、屋内に設置された特殊な壁や課題ルートを備えています。雨の日でも施設内は快適な環境であり、天候に左右されずにボルダリングを楽しむことができます。以下に、雨の日にボルダリング施設で得られる楽しみと利点をいくつかご紹介します。<br />\r\n<br />\r\n雨の日でも安全に楽しめる: 屋内のボルダリング施設では、天候の影響を受けずに安全にボルダリングを楽しむことができます。特殊なマットが敷かれているため、落下してもクッションされるため怪我のリスクが低く、初心者や子供たちも安心して参加できます。<br />\r\n<br />\r\nチームや仲間との共有体験: ボルダリングは個人競技ではありますが、施設内では他の参加者と交流する機会もあります。雨の日に仲間や友人と一緒にボルダリング施設を訪れることで、一緒に課題に挑戦したり、アドバイスをし合ったりすることで、共有体験を楽しむことができます。<br />\r\n<br />\r\nボルダリングの魅力と挑戦: ボルダリングは、高い壁や複雑な課題に挑戦することで、身体能力や筋力、バランス感覚を鍛えることができます。施設内には様々なレベルや難易度の課題が用意されており、初心者から上級者まで幅広いレベルの参加者が楽しむことができます。<br />\r\n<br />\r\n心と体のリフレッシュ: ボルダリングは、身体だけでなく心の健康にも良い影響を与えます。課題に集中することで日常のストレスや疲労を忘れし、新たなエネルギーを充電することができます。ボルダリングは全身の筋肉を使うため、運動不足の解消や体力向上にも効果的です。また、課題をクリアする達成感や、自分の限界に挑戦する喜びも味わえます。<br />\r\n<br />\r\n進歩と成長の実感: ボルダリングは自己の向上を実感しやすいスポーツです。初めは難しい課題でも、継続的なトレーニングと努力によって徐々にクリアできるようになります。その過程で技術や戦略を学び、自分自身の成長を実感することができます。<br />\r\n<br />\r\n雨の日でも気分転換に最適: 雨の日は外出やアウトドア活動が制限されるため、室内での適度な運動や気分転換が重要です。ボルダリングは、室内でのスポーツとして手軽に楽しむことができます。雨の日でも施設を訪れることで、普段とは異なる刺激を受けながらリフレッシュすることができます。<br />\r\n<br />\r\n雨の日にボルダリング施設を利用することで、安全に楽しみながら心と体を活性化させることができます。難易度の異なる課題に挑戦しながら、成長や達成感を味わい、新たなチャレンジを楽しむことができるでしょう。ボルダリングは雨の日の室内アクティビティとして最適であり、幅広い年齢層や体力レベルの人々にとって楽しみながら健康を促進する選択肢となります。', 0x7075626c69632f696d672f363439393335376231323664395f363439393335373735376233625f626f756c646572696e672e6a7067, '2023-06-24', 0, '2023-06-26'),
(3, 1, '雨の日に見る夜空？！プラネタリウムの魅力', 'プラネタリウムは、雨の日でも楽しめる室内施設として人気を持っています。プラネタリウムは、天体観測を模擬した特別なドーム内で、美しい星空や宇宙の映像を映し出す施設です。以下では、雨の日でも楽しめるプラネタリウムの魅力と利点についてご紹介します。<br />\r\n<br />\r\n雨の日でも屋内で星空を楽しむ: 雨の日は外出や屋外活動が制限されますが、プラネタリウムは屋内施設なので天候に左右されずに星空を楽しむことができます。ドーム内に座り、美しい映像や音楽に包まれながら、まるで宇宙の旅に出かけたかのような体験ができます。<br />\r\n<br />\r\n宇宙の不思議を学ぶ: プラネタリウムでは、天文学や宇宙の知識を学ぶ機会も提供されます。専門の解説員や映像を通じて、星座や惑星の名前や特徴、宇宙の歴史などについて深く理解することができます。雨の日にプラネタリウムを訪れることで、知識を増やし、宇宙の不思議に触れる貴重な体験ができます。<br />\r\n<br />\r\nリラックスや癒しの場として利用できる: プラネタリウムの映像や音楽は、リラックスや癒しの効果もあります。ドーム内の静寂な空間でゆったりと座り、美しい星空の映像と共に心地よい音楽に浸ることで、日常のストレスや緊張を忘れ、リフレッシュすることができます。<br />\r\n<br />\r\n子供から大人まで楽しめる: プラネタリウムは年齢や興味関心に関係なく、幅広い人々に楽しまれています。子供たちは宇宙の神秘を探求することで科学への興味を刺激し、大人は日常の喧騒を忘れて宇宙の壮大さに感動することができます。家族や友人と一緒にプラネタリウムを訪れることで、共有体験を楽しむこともできます。', 0x7075626c69632f696d672f61727469636c65363439373032663763656334625f363439373032663138346334625f6b6f6e6963616d696e6f6c74612e6a7067, '2023-06-24', 0, '2023-06-24');

-- --------------------------------------------------------

--
-- テーブルの構造 `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL COMMENT '企業ID',
  `email` varchar(100) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(100) NOT NULL COMMENT 'パスワード',
  `company_name` varchar(50) NOT NULL COMMENT '企業名',
  `company_kana` varchar(50) NOT NULL COMMENT 'フリガナ',
  `area_id` int(11) NOT NULL COMMENT '地域ID',
  `adress` varchar(100) NOT NULL COMMENT '所在地',
  `tell` varchar(16) NOT NULL COMMENT '電話番号',
  `created_at` int(11) NOT NULL COMMENT '作成日',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '削除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `companies`
--

INSERT INTO `companies` (`company_id`, `email`, `password`, `company_name`, `company_kana`, `area_id`, `adress`, `tell`, `created_at`, `deleted`) VALUES
(1, 'aaaa@gmail.com', '1111aaaa', 'test', 'テスト', 1, '名古屋市', '05212345678', 20230615, 0),
(2, 'admin@gmail.com', '$2y$10$xMr10NxLpdDh86Y2w.nO8.ofKikWcCwOPWpQIXOmRZf52QaYWzIKe', 'カフェ ラフィネ', 'カフェ ラフィネ', 23, '名古屋市中村区名駅3-13-27 モンブランホテル ラフィネ名古屋駅前 1階', '0525411121', 20230620, 0),
(3, 'sample@gmail.com', '$2y$10$lDRgt1IF5x3VWTY56zEAz.VhLtWxbQdjg6zTIgHd3Mj95/i4slbAK', '鮨 よこ田', 'すし よこた', 23, '名古屋市中村区椿町10-4 サン・タウン名駅椿', '050-5571-2569', 20230620, 0),
(4, 'admin@gmai.com', '$2y$10$NRFFYuXb31LoSp9otI4Q5eqxaMl3MapmLsRmnFmt9eEv3P3qEAghm', 'とんかつあさくら', 'とんかつあさくら', 23, '名古屋市緑区滝の水1-809 エルパティオ滝ノ水', '052-896-1732', 20230620, 0),
(5, 'admin@gmail.com', '', '4000 Chinese Restaurant', 'フォーサウザンドチャイニーズレストラン', 13, '港区南青山7-10-10 パークアクシス南青山7丁目', '050-5597-3644', 20230620, 0),
(6, 'admin@gmail.com', '$2y$10$n20iCKcApInmoM1sGcAcj.tUBgJcn6pfe20L4SPOMGmUsLj8mCY/q', '中華そば しば田', 'ちゅうかそばしばた', 13, '調布市若葉町2-25-20', '080-4001-0233', 20230620, 0),
(7, 'admin@gmail.com', '$2y$10$iaFCifLFT.feHWlYlTjSzeXUftugkd1T7j6szvPVxXfsP5M5G7IOi', '肉山 おおみや', 'にくやまおおみや', 11, 'さいたま市大宮区桜木町2-2-5 松村ビル', '050-5456-3470', 20230620, 0),
(8, 'testcompany@test.com', '$2y$10$OVah/VlC09PMbhRqc9MrN.TGXG6DD0ayH16kKWGIpXcvUR0b0iJn.', 'testcompany', 'テストカンパニー', 11, 'さいたま市大宮区桜木町2-2-5 松村ビル', '050-5456-3470', 20230627, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL COMMENT 'クーポン名',
  `area_id` int(11) NOT NULL COMMENT '地域ID',
  `company_id` int(11) NOT NULL COMMENT '企業ID',
  `coupon_name` varchar(50) NOT NULL COMMENT 'クーポン名',
  `coupon_description` varchar(300) NOT NULL COMMENT 'クーポン内容',
  `expiry` date NOT NULL COMMENT '有効期限',
  `terms_and_conditions` varchar(300) NOT NULL COMMENT '利用条件',
  `coupon_img` blob NOT NULL,
  `created_at` date NOT NULL COMMENT '作成日',
  `updated_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '削除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `area_id`, `company_id`, `coupon_name`, `coupon_description`, `expiry`, `terms_and_conditions`, `coupon_img`, `created_at`, `updated_at`, `deleted`) VALUES
(29, 13, 6, 'トッピング1品（100円）or大盛サービス', 'お好きなトッピングから1品（100円）もしくは大盛が無料', '2023-07-31', '注文時にスタッフにご提示ください', 0x7075626c69632f696d672f363439393062373164343735335f363439393062366635393236355f73616d706c65372e6a7067, '2023-06-19', '2023-06-26 12:52:17', 0),
(30, 13, 5, 'ビール日本酒以外のドリンク1杯サービス', 'ビール日本酒以外のドリンク1杯×人数分サービス', '2023-07-31', '注文時にスタッフに提示してください', 0x7075626c69632f696d672f363439326339383463313939305f363439326339383236396139315f73616d706c65352e6a7067, '2023-06-19', '2023-06-21 18:57:24', 0),
(31, 23, 4, 'サイドメニュー1品無料', 'サイドメニュー（500円以下）から1品無料', '2023-07-31', '注文時にスタッフに提示（１グループで１品のみ）', 0x7075626c69632f696d672f363439393063656430333435385f363439393063653764373634635f73616d706c65342e6a706567, '2023-06-19', '2023-06-26 12:58:37', 0),
(32, 23, 3, '旬の握り1貫サービス', '旬の握り1貫サービス', '2023-07-31', '1000円以上のお会計時のみ適応', 0x7075626c69632f696d672f363439333335623333623238635f363439333335616564653665395f73616d706c65362e6a7067, '2023-06-19', '2023-06-22 02:38:59', 0),
(33, 23, 2, '【ランチのみ】お会計から10％引き', 'お会計から10％引き', '2023-07-31', 'ランチのみ。お会計時にスタッフに提示してください。', 0x7075626c69632f696d672f363439326339626339303663615f363439326339623964346265335f73616d706c65312e6a7067, '2023-06-19', '2023-06-21 18:58:20', 0),
(35, 11, 7, 'お会計10％OFF', 'お会計から10％OFF', '2023-07-31', '3,000円以上のお会計のみ適応。お会計時にスタッフへご提示ください。', 0x7075626c69632f696d672f363439326361646532633238615f363439326361646334383330315f73616d706c65322e6a7067, '2023-06-21', '2023-06-21 19:03:10', 0),
(36, 2, 1, 'test', 'test', '2023-06-23', 'test', 0x7075626c69632f696d672f363439333137363538663661665f363439333137363265306264615f636f75706f6e73616d706c652e6a7067, '2023-06-22', '2023-06-22 01:01:38', 1),
(37, 3, 4, 'テスト', 'テスト', '2023-06-28', 'ああああ', 0x7075626c69632f696d672f363439393264343730626234345f363439393264343264383630375f73616d706c65312e6a7067, '2023-06-26', '2023-06-26 15:17:47', 1),
(38, 11, 8, '【雨の日限定！】お会計から10％OFF', 'お会計から10％OFF', '2023-07-31', '3,000円以上のお会計のみ適応。お会計時にスタッフへご提示ください。', 0x7075626c69632f696d672f363439396361366439653934615f363439396361363662373637655f73616d706c65322e6a7067, '2023-06-27', '2023-06-27 02:27:09', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_06_12_181905_create_areas_table', 2),
(5, '2014_10_12_000000_create_users_table', 3),
(6, '2023_06_24_000456_add_remember_token_to_users_table', 3),
(7, '2023_06_26_180437_create_likes_table', 4),
(8, '2023_06_26_191401_likes', 5);

-- --------------------------------------------------------

--
-- テーブルの構造 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
  `email` varchar(100) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(100) NOT NULL COMMENT 'パスワード',
  `user_name` varchar(30) NOT NULL COMMENT 'ユーザー名',
  `area_id` int(11) NOT NULL COMMENT '地域ID',
  `created_at` datetime NOT NULL COMMENT '作成日',
  `updated_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '削除',
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `user_name`, `area_id`, `created_at`, `updated_at`, `deleted`, `remember_token`) VALUES
(2, 'aaaa@gmail.com', '$2y$10$yewren4i17Yd5UFYyFEXoeRMWjJ4xA4m71VTS91ABiVt3KwwAGYUW', 'yama', 1, '2023-06-14 18:04:50', '2023-06-14 18:04:50', 0, NULL),
(4, '1234@gmail.com', '$2y$10$OFN3EoWwbv1Thi.BZrqb/.s6MgI5DthrH6qjPiY4d21/UEwNs5yGe', 'yama', 2, '2023-06-26 01:03:16', '2023-06-26 01:15:56', 0, 'eDBkArCmTTGkNFZsJCYOWPzO7Z9LdwZ3rwUz9ALzVFT5tgkSiCf9t0chesFn'),
(5, 'test@test.com', '$2y$10$xTDvaP8K9RMc5r63Ydion.eC36/N73S/9upx0mvTJ0WkUCxGn..A.', 'tester', 13, '2023-06-27 01:35:12', '2023-06-27 01:35:12', 0, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `user_coupon`
--

CREATE TABLE `user_coupon` (
  `user_coupon_id` int(11) NOT NULL COMMENT '保有クーポンID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
  `coupon_id` int(11) NOT NULL COMMENT 'クーポンID',
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL COMMENT '保存日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user_coupon`
--

INSERT INTO `user_coupon` (`user_coupon_id`, `user_id`, `coupon_id`, `updated_at`, `created_at`) VALUES
(1, 2, 32, '2023-06-21', '2023-06-21'),
(2, 2, 35, '2023-06-23', '2023-06-23'),
(3, 2, 35, '2023-06-26', '2023-06-26'),
(4, 2, 35, '2023-06-26', '2023-06-26'),
(5, 2, 33, '2023-06-27', '2023-06-27'),
(6, 2, 31, '2023-06-27', '2023-06-27'),
(7, 5, 35, '2023-06-27', '2023-06-27'),
(8, 5, 33, '2023-06-27', '2023-06-27');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- テーブルのインデックス `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`area_id`);

--
-- テーブルのインデックス `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

--
-- テーブルのインデックス `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- テーブルのインデックス `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- テーブルのインデックス `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- テーブルのインデックス `user_coupon`
--
ALTER TABLE `user_coupon`
  ADD PRIMARY KEY (`user_coupon_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理者ID', AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `areas`
--
ALTER TABLE `areas`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地域ID', AUTO_INCREMENT=48;

--
-- テーブルの AUTO_INCREMENT `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '記事ID', AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '企業ID', AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'クーポン名', AUTO_INCREMENT=39;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ユーザーID', AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `user_coupon`
--
ALTER TABLE `user_coupon`
  MODIFY `user_coupon_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '保有クーポンID', AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
