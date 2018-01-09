<?php

use Illuminate\Database\Seeder;

use App\Type;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->delete();

        Type::create([
            'name' => 'BTS',
            'folder' => 'BTS',
            'discription' => '韓國饒舌男子音樂組合，由V、Jin、Jimin、Jung Kook、RM、SUGA、j-hope七名成員組成，隸屬Big Hit Entertainment經紀公司旗下。
團體剛出道時，防彈少年團的涵義為「阻擋像子彈一樣的批評與時代偏見的音樂團體」，2017年7月4日則加入了「不安於現狀，朝著夢想不斷成長的青春」的涵義，原先以「防彈少年團」為英文縮寫的「BTS」（Bangtan Sonyeon Dan），也增添了「Beyond The Scene」超越現狀的意思。
防彈少年團歌迷的官方名稱為「A.R.M.Y」，ARMY在英文中是軍隊的意思，防彈衣和軍隊總是一起的，也有粉絲們也和防彈少年團一直一起的意思。同時也是「 Adorable Representative M.C for Youth 」的縮寫（值得人景仰的青年饒舌代表）',
            'supplier_id' => '1'
        ]);

        Type::create([
            'name' => 'GOT7',
            'folder' => 'GOT7',
            'discription' => '是韓國JYP娛樂於2014年推出的7人男子團體，由四名韓國成員JB、珍榮、榮宰、有謙，及三名外籍成員，分別是美籍華裔的Mark、香港的Jackson，以及泰國的BamBam組成，由JB擔任隊長。
是JYP娛樂的首支嘻哈團體，由多國籍成員組成，擅長表演「martial arts tricking」（又名「MAT」）。GOT7的寓意為「7個幸運的人聚集在一起直到永遠」。
官方粉絲名為「I GOT7」，意思是「歌迷們同時擁有了GOT7與幸運」，而成員們也經常暱稱歌迷為「아가새」（發音為Ah-Ga-Se），是韓文「鳥寶寶」的意思，官方應援物為綠色鳥狀手燈。',
            'supplier_id' => '4'
        ]);

        Type::create([
            'name' => 'DAY6',
            'folder' => 'DAY6',
            'discription' => '是韓國JYP娛樂於2015年推出的六人男子樂團，原由Jae、晟鎮、晙赫、Young K、元弼及度雲6位成員組成，由晟鎮擔任隊長。2016年時成員晙赫退出DAY6並與JYP娛樂終止合約，自此DAY6成為五人樂團。
成員們不僅參與專輯所有詞曲創作，全團同時擔任演奏與vocal的型態，是韓語流行樂壇少見的風格。
團名由朴軫永命名，DAY6六位成員共代表一周裡的6天，第7天則是代表歌迷，由大家組成了一周，並周而復始的不斷循環下去。官方粉絲名為「My Day」，寓意為DAY6與歌迷成為填滿彼此每一天的珍貴存在。',
            'supplier_id' => '4'
        ]);

        Type::create([
            'name' => 'TWICE',
            'folder' => 'TWICE',
            'discription' => '韓國JYP娛樂旗下的九人女子組合，成員透過Mnet生存實境節目《SIXTEEN》篩選而出。最終由五名韓國成員娜璉、定延、志效、多賢、彩瑛，三名日本成員Momo、Sana、Mina，以及一名臺灣成員子瑜所組成，並由志效擔任隊長。
官方粉絲名為「ONCE」，應援色為杏桃黃與霓洋紅，應援物為白底配應援色的棒棒糖幻彩手燈（Candy Bong）。
團名「TWICE」由公司創辦者朴軫永取名，寓意為「透過舞台令耳朵得到感動之後，再為眼睛帶來多一次感動。」。TWICE除了會繼承JYP娛樂旗下女子組合的風格，還會增加嘻哈元素及野性奔放的感覺。',
            'supplier_id' => '4'
        ]);

        Type::create([
            'name' => 'BIGBANG',
            'folder' => 'BIGBANG',
            'discription' => 'YG娛樂於2006年推出的韓國男子音樂組合，由T.O.P、太陽、G-Dragon、大聲及勝利五名成員組成，G-Dragon擔任隊長一職，而他們的團體名稱「BIGBANG」為宇宙大爆炸之意(The Big Bang Theory)，意味著將對於韓國音樂界，甚至在全世界帶來爆炸性的影響，官方的歌迷名稱則是「V.I.P」，其意思為「Very Important People」，是根據第二張單曲《BIGBANG Is V.I.P》命名，有著粉絲是非常重要的人的含意。官方應援物為黃色皇冠造型手燈。',
            'supplier_id' => '2'
        ]);

        Type::create([
            'name' => 'HIGHLIGHT',
            'folder' => 'HIGHLIGHT',
            'discription' => '韓國的五人男子團體，前身為BEAST。現任成員有尹斗俊、龍俊亨、梁耀燮、李起光、孫東雲。2017年3月20日以全新的名字「Highlight」展開活動，寓意為最明亮的部分、最顯眼的存在。同年6月2日，公開新粉絲名為Light。',
            'supplier_id' => '3'
        ]);

        Type::create([
            'name' => 'WannaOne',
            'folder' => 'WannaOne',
            'discription' => '依據Mnet節目《PRODUCE 101 第二季》的出道承諾，於2017年成立的韓國男子演唱團體，該節目是由BoA擔任國民製作人代表，韓國國民擔任製作人，以投票方式決定成員；
成員包括尹智聖、河成雲、黃旼炫、邕聖祐、金在奐、姜丹尼爾、朴志訓、朴佑鎭、裴珍映、李大輝、賴冠霖。2017年以YMC娛樂旗下藝人身份正式出道，進行為期一年半的限定活動。
團名包含國民製作人與11位成員成為一體的意義，其取自「Produce 101」的「101」英文「One O One」之諧音。官方粉絲名「Wannable」（韓語：워너블 Wo Neo Beul）是由Wanna One親自選出，意思是「讓我們一起將所有希望的都成真吧」。',
            'supplier_id' => '5'
        ]);

        // Type::create([
        //     'name' => 'GIRLSGENERATION',
        //     'folder' => 'GIRLSGENERATION',
        //     'discription' => '',
        //     'supplier_id' => ''
        // ]);

        // Type::create([
        //     'name' => 'BLACKPINK',
        //     'folder' => 'BLACKPINK',
        //     'discription' => '',
        //     'supplier_id' => '2'
        // ]);



        DB::table('products')->delete();

        Product::create([
            'name' => 'BIGBANG MADE SERIES [M]',
            'photo' => '/image/products/BIGBANG/MadeSeriesM.jpg',
            'cost' => '200',
            'price' => '418',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '2',
            'sales_amount' => '8',
            'lost_amount' => '0',
            'type_id' => '5'
        ]);
        Product::create([
            'name' => 'BIGBANG MADE SERIES [A]',
            'photo' => '/image/products/BIGBANG/MadeSeriesA.jpg',
            'cost' => '200',
            'price' => '418',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '6',
            'sales_amount' => '4',
            'lost_amount' => '0',
            'type_id' => '5'
        ]);
        Product::create([
            'name' => 'BIGBANG MADE SERIES [D]',
            'photo' => '/image/products/BIGBANG/MadeSeriesD.jpg',
            'cost' => '200',
            'price' => '418',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '8',
            'sales_amount' => '2',
            'lost_amount' => '0',
            'type_id' => '5'
        ]);
        Product::create([
            'name' => 'BIGBANG MADE SERIES [E]',
            'photo' => '/image/products/BIGBANG/MadeSeriesE.jpg',
            'cost' => '200',
            'price' => '418',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '5'
        ]);
        Product::create([
            'name' => 'BIGBANG MADE THE FULL ALBUM',
            'photo' => '/image/products/BIGBANG/MadeFullAlbum.jpg',
            'cost' => '750',
            'price' => '988',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '8',
            'sales_amount' => '2',
            'lost_amount' => '0',
            'type_id' => '5'
        ]);

        Product::create([
            'name' => 'CAN YOU FEEL IT?',
            'photo' => '/image/products/HIGHLIGHT/CanYouFeelIt.jpg',
            'cost' => '200',
            'price' => '468',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '7',
            'sales_amount' => '3',
            'lost_amount' => '0',
            'type_id' => '6'
        ]);
        Product::create([
            'name' => 'CALLING YOU',
            'photo' => '/image/products/HIGHLIGHT/CallingYou.jpg',
            'cost' => '200',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '6',
            'sales_amount' => '4',
            'lost_amount' => '0',
            'type_id' => '6'
        ]);
        Product::create([
            'name' => 'CELEBRATE',
            'photo' => '/image/products/HIGHLIGHT/Celebrate.jpg',
            'cost' => '200',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '6'
        ]);

        Product::create([
            'name' => '2 Cool 4 Skool',
            'photo' => '/image/products/BTS/2Cool4Skool.jpg',
            'cost' => '150',
            'price' => '358',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);
        Product::create([
            'name' => 'O!RUL8,2?',
            'photo' => '/image/products/BTS/O!RUL8,2.jpg',
            'cost' => '150',
            'price' => '398',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);
        Product::create([
            'name' => 'Skool Luv Affair',
            'photo' => '/image/products/BTS/SkoolLuvAffair.jpg',
            'cost' => '150',
            'price' => '398',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);
        Product::create([
            'name' => 'Dark & Wild',
            'photo' => '/image/products/BTS/Dark&Wild.jpg',
            'cost' => '220',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '7',
            'sales_amount' => '3',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);
        Product::create([
            'name' => '花樣年華 pt.1',
            'photo' => '/image/products/BTS/Pt.1.jpg',
            'cost' => '200',
            'price' => '448',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '7',
            'sales_amount' => '3',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);
        Product::create([
            'name' => '花樣年華 pt.2',
            'photo' => '/image/products/BTS/Pt.2.jpg',
            'cost' => '200',
            'price' => '458',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '7',
            'sales_amount' => '3',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);
        Product::create([
            'name' => 'Young Forever',
            'photo' => '/image/products/BTS/YoungForever.jpg',
            'cost' => '350',
            'price' => '678',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '7',
            'sales_amount' => '3',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);
        Product::create([
            'name' => 'WINGS',
            'photo' => '/image/products/BTS/Wings.jpg',
            'cost' => '200',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '2',
            'inventory' => '10',
            'sales_amount' => '0',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);
        Product::create([
            'name' => 'You Never Walk Alone',
            'photo' => '/image/products/BTS/YouNeverWalkAlone.jpg',
            'cost' => '250',
            'price' => '588',
            'total_amount' => '10',
            'order_amount' => '2',
            'inventory' => '10',
            'sales_amount' => '0',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);
        Product::create([
            'name' => 'LOVE YOURSELF 承 Her',
            'photo' => '/image/products/BTS/LoveYourself.jpg',
            'cost' => '200',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '1',
            'inventory' => '10',
            'sales_amount' => '0',
            'lost_amount' => '0',
            'type_id' => '1'
        ]);

        Product::create([
            'name' => 'Got it?',
            'photo' => '/image/products/GOT7/GotIt.jpg',
            'cost' => '200',
            'price' => '388',
            'total_amount' => '10',
            'order_amount' => '5',
            'inventory' => '10',
            'sales_amount' => '0',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);
        Product::create([
            'name' => 'GOT♡',
            'photo' => '/image/products/GOT7/GotLove.jpg',
            'cost' => '200',
            'price' => '398',
            'total_amount' => '10',
            'order_amount' => '5',
            'inventory' => '10',
            'sales_amount' => '0',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);
        Product::create([
            'name' => 'Identify',
            'photo' => '/image/products/GOT7/Identify.jpg',
            'cost' => '300',
            'price' => '488',
            'total_amount' => '10',
            'order_amount' => '5',
            'inventory' => '10',
            'sales_amount' => '0',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);
        Product::create([
            'name' => 'Just Right',
            'photo' => '/image/products/GOT7/JustRight.jpg',
            'cost' => '200',
            'price' => '398',
            'total_amount' => '10',
            'order_amount' => '3',
            'inventory' => '10',
            'sales_amount' => '0',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);
        Product::create([
            'name' => 'MAD',
            'photo' => '/image/products/GOT7/Mad.jpg',
            'cost' => '200',
            'price' => '398',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '7',
            'sales_amount' => '3',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);
        Product::create([
            'name' => 'MAD Winter Edition',
            'photo' => '/image/products/GOT7/MadWinterEdition.jpg',
            'cost' => '850',
            'price' => '968',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '7',
            'sales_amount' => '3',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);
        Product::create([
            'name' => 'FLIGHT LOG:DEPARTURE',
            'photo' => '/image/products/GOT7/Departure.jpg',
            'cost' => '200',
            'price' => '398',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '8',
            'sales_amount' => '2',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);
        Product::create([
            'name' => 'FLIGHT LOG:TURBULENCE',
            'photo' => '/image/products/GOT7/Turbulence.jpg',
            'cost' => '200',
            'price' => '518',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '8',
            'sales_amount' => '2',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);
        Product::create([
            'name' => 'FLIGHT LOG:ARRIVAL',
            'photo' => '/image/products/GOT7/Arrival.jpg',
            'cost' => '300',
            'price' => '468',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '9',
            'sales_amount' => '1',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);
        Product::create([
            'name' => '7 FOR 7',
            'photo' => '/image/products/GOT7/7for7.jpg',
            'cost' => '200',
            'price' => '438',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '10',
            'sales_amount' => '0',
            'lost_amount' => '0',
            'type_id' => '2'
        ]);

        Product::create([
            'name' => 'The Day',
            'photo' => '/image/products/DAY6/TheDay.jpg',
            'cost' => '200',
            'price' => '448',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '3'
        ]);
        Product::create([
            'name' => 'DAYDREAM',
            'photo' => '/image/products/DAY6/DayDream.jpg',
            'cost' => '200',
            'price' => '428',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '3'
        ]);
        Product::create([
            'name' => 'SUNRISE',
            'photo' => '/image/products/DAY6/Sunrise.jpg',
            'cost' => '250',
            'price' => '480',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '3'
        ]);
        Product::create([
            'name' => 'MOONRISE',
            'photo' => '/image/products/DAY6/Moonrise.jpg',
            'cost' => '250',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '3'
        ]);

        Product::create([
            'name' => 'The Story Begins',
            'photo' => '/image/products/TWICE/TheStoryBegins.jpg',
            'cost' => '200',
            'price' => '428',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '4'
        ]);
        Product::create([
            'name' => 'Page Two',
            'photo' => '/image/products/TWICE/PageTwo.jpg',
            'cost' => '300',
            'price' => '518',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '4'
        ]);
        Product::create([
            'name' => 'TWICEcoaster:LANE 1',
            'photo' => '/image/products/TWICE/Lane1.jpg',
            'cost' => '300',
            'price' => '518',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '4'
        ]);
        Product::create([
            'name' => 'TWICEcoaster:LANE 2',
            'photo' => '/image/products/TWICE/Lane2.jpg',
            'cost' => '250',
            'price' => '488',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '4'
        ]);
        Product::create([
            'name' => 'SIGNAL',
            'photo' => '/image/products/TWICE/Signal.jpg',
            'cost' => '250',
            'price' => '488',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '4'
        ]);
        Product::create([
            'name' => 'Twicetagram',
            'photo' => '/image/products/TWICE/Twicetagram.jpg',
            'cost' => '250',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '4'
        ]);
        Product::create([
            'name' => 'Merry&Happy',
            'photo' => '/image/products/TWICE/Merry&Happy.jpg',
            'cost' => '250',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '4'
        ]);

        Product::create([
            'name' => '1-1=0',
            'photo' => '/image/products/WannaOne/1-1=0.jpg',
            'cost' => '250',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '7'
        ]);
        Product::create([
            'name' => '1X1=1',
            'photo' => '/image/products/WannaOne/1X1=1.jpg',
            'cost' => '250',
            'price' => '498',
            'total_amount' => '10',
            'order_amount' => '0',
            'inventory' => '5',
            'sales_amount' => '5',
            'lost_amount' => '0',
            'type_id' => '7'
        ]);

    }
}
