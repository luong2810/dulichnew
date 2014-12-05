<?php
class DesignController extends BaseController {

    public function getIndex()
    {
        //
        return View::make('design.index');
    }

    public function getGroup()
    {
        //
        return View::make('design.group');
    }

    public function getDichvu()
    {
        //
    }

    public function getDatabase()
{

//         for($i=1000;$i<1991;$i++){
//             $user = new MemberAccounts;
//             $rand = rand(100,900);
//             $user->user_name = 'taikhoan'.$i;
//             $user->password = 'matkhau'.$i;
//             $user->email = 'email@hostmail.abc'.$i;
//             if($rand%2==0){
//                 $user->type_member = 'member';
//             } else {
//                 $user->type_member = 'trademark';
//                  $trademark = new Trademarks;
//                  $trademark->trademark_name='trademark'.$i;
//                  $trademark->description='Đầu tiên, Công ty Cổ Phần Đầu Tư Thương Mại và Dịch Vụ Du Lịch Đất Việt (Đất Việt Tour) xin gửi đến Quý khách hàng lời chào trân trọng nhất!\\
// Với hơn 14 năm phát triển, chúng tôi đã và đang từng bước khẳng định được thương hiệu của mình trên thị trường du lịch đầy cạnh tranh và hân hạnh là đơn vị tổ chức đa dạng về đối tượng và loại hình du lịch.\\
// Chúng tôi hiểu rằng giá trị của thương hiệu được hình thành từ sự tin yêu của khách hàng. Vì vậy, mục tiêu của mỗi chuyến du lịch không chỉ là sự hài lòng của khách hàng mà còn là dấu ấn về sự tận tâm của đội ngũ cán bộ và nhân viên Đất Việt Tour.';
//                  $trademark->logo='logo.jpg';
//                  $trademark->user_id=$i+1;
//                  $trademark->save();
//             }
//             $user->save();
//             // var_dump($user);
//         }



        // for($i=0;$i<500;$i++){
        //     $user = new Groups;
        //     $rand = rand(100,900);
        //     $user->group_name = 'Hành trình phượt Sapa, phượt đập cá biển';
        //     $user->description = 'Giới trẻ vẫn gọi “phượt” là đi để khám phá và chinh phục; đi để giải tỏa căng thẳng, làm mới mình và trên hết là đi để thử thách mình. “Phượt” để cảm nhận không khí đón xuân trên mọi vùng miền của đất nước. “Phượt” để đón lộc đầu năm, giao hòa với thiên nhiên tràn trề nhựa sống. Và “phượt” giúp con người gần lại với nhau hơn, tình bạn thêm gắn bó';
        //     if($rand%10<=7){
        //         $user->privacy = 'public';
        //     } else {
        //         $user->privacy = 'private';
        //     }
        //     $user->save();
        //     var_dump($user);
        // }

      // for($i=0;$i<2500;$i++){
      //       $user = new GroupMembers;
      //       $rand = rand(1,3000);
      //       $user->user_id = rand(1,1990);
      //       $user->group_id = rand(1,500);
      //       $user->status = 'joined';
      //       if($rand%10<=5){
      //           $user->office = 'member';
      //       } else if($rand%10<8){
      //           $user->office = 'admin';
      //       } else{
      //           $user->office = 'register';
      //           $user->status = 'wait';
      //       }

      //       $user->save();
      //       // var_dump($user);
      //   }

//           for($i=0;$i<2500;$i++){
//             $user = new GroupPlans;
//             $rand = rand(1,3000);
//             $user->location = 'Phố Cổ';
//             $user->content = 'Những năm gần đây, đi “phượt” đã trở thành trào lưu du lịch phổ biến trong giới trẻ nước ta. Ngoài mục đích khám phá những vùng đất mới, tìm hiểu về văn hóa bản địa và nghỉ ngơi thư giãn, “phượt” còn giúp các bạn trẻ trang bị những kỹ năng sống cần thiết.\\
// Trong chuyến hành trình “phượt” về miền Tây lần này, các bạn hãy chuẩn bị sẵn sàng kế hoạch cụ thể trước khi bắt đầu hành trình khám phá của mình.';
//             $user->date_event = date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days'));;
//             $user->group_id = rand(1,500);  
//             if($rand%10<3){
//                 $user->status = 'prepare';
//             } else if($rand%10<5){
//                 $user->status = 'performing';
//             }else if($rand%10<8){
//                 $user->status = 'fail';
//             } else{
//                 $user->status = 'finish';
//             }

//             $user->save();
//             // var_dump($user);
//         }

        //  for($i=0;$i<500;$i++){
        //     $user = new Services;
        //     $rand = rand(1,3000);
        //     $user->service_name = 'Dịch vụ'.$rand;
        //     // $user->type_service = 'Giải Trí';
        //     $user->location = 'Hoàng Thành';
        //     $user->description = 'Paintball là một trò chơi thể thao du lich Teambuilding, người chơi chia thành nhiều nhóm hay cá nhân, cạnh tranh nhau để loại bỏ đối thủ. Các đội mặc quần áo quân đội và bắn nhau bằng một khẩu súng đặc biệt, viên đạn chứa sơn (gọi tắt là paintball). Người chơi nào trúng màu sơn coi như bị loại ra khỏi trận địa.';
        //     $user->trademark_id = rand(1,1037); 

        //     if($rand%10<3){
        //         $user->type_service = 'Ăn Uống';
        //     } else if($rand%10<5){
        //         $user->type_service = 'Giải Trí';
        //     }else if($rand%10<8){
        //         $user->type_service = 'Phương Tiện';
        //     } else{
        //         $user->type_service = 'Nguyên Liệu';
        //     }

        //     $user->save();
        //     // var_dump($user);
        // }

    // for($i=0;$i<2500;$i++){
    //         $user = new Postss;
    //         $rand = rand(1,3000);
    //         $user->title = 'Xuyên rừng Cúc Phương đại ngàn';
    //         // $user->type_service = 'Giải Trí';
    //         $user->location = 'Tam Đảo';
    //         $user->content = 'Chinh phục Cúc Phương – Một chương trình du lịch kết hợp Teambuilding được thiết kế với thời lượng 3 ngày 2 đêm. Địa điểm là Vườn quốc gia Cúc Phương – Ninh Bình. Hành trình Amazing đến với Cúc Phương là sự trải qua nhiều thử thách mà không một thành viên nào trong đội ngờ tới, rèn luyện kỹ năng phán đoán và xử lý tình huống bất ngờ, kỹ năng đàm phán thuyết phục. Đặc biệt chỉ có sự đoàn kết giữa các thành viên trong Team mới có thể vượt qua các thử thách một cách dễ dàng tại Nho Quan và Me. Và đích đến cuối cùng là Vườn quốc gia Cúc Phương. Tại đây, chương trình Teambuilding với nhiều trạm thử thách cả về cân não & cân sức sẽ được diễn ra. Các Teams chuẩn bị đối đầu với thử thách và đưa ra chiến thuật hợp lý để dành chiến thắng trong trạm cuối cùng.';
    //         $user_id = rand(1,1990); 
    //         $group_id = rand(1,500); 
    //         $service_id = rand(1,500); 

    //         if($rand%10<4){
    //             $user->type_posts = 'user';
    //             $user->user_id = $user_id;
    //         } else if($rand%10<7){
    //             $user->type_posts = 'group';
    //              $user->group_id = $group_id;
    //         } else{
    //             $user->type_posts = 'service';
    //              $user->service_id = $service_id;
    //         }

    //         $user->save();
    //         // var_dump($user);
    //     }

    // for($i=0;$i<5000;$i++){
    //         $user = new Messages;
    //         $rand = rand(1,3000);
    //         $user->title = 'Xác nhận tham gia nhóm';
    //         $user->content = 'Đây là tin nhăn gửi cho bạn. Đây là tin nhăn gửi cho bạn. Đây là tin nhăn gửi cho bạn. ';
    //         $user->user_id_from = rand(1,1990); 
    //         $user->user_id_to = rand(1,1990); 

    //         if($rand%10<4){
    //             $user->type_message = 'user';
    //         } else if($rand%10<7){
    //             $user->type_message = 'group';
    //         } else{
    //             $user->type_message = 'service';
    //         }

    //         $user->save();
    //         // var_dump($user);
    //     }

    // for($i=0;$i<15000;$i++){
    //         $user = new Images;
    //         $rand = rand(1,120);
    //         $user->link = 'hinhanh'.$rand.'.jpg';
    //         $user->title = 'Ảnh minh họa cho bài viết hoặc chia sẻ hình ảnh';
    //         $user->posts_id = rand(1,15000); 

    //         if($rand%10<7){
    //             $user->privacy = 'public';
    //         } else{
    //             $user->privacy = 'private';
    //         }

    //         $user->save();
    //         // var_dump($user);
    //     }
    //     echo "string";
    // }

    // $reply_id=0;
    //  for($i=0;$i<15000;$i++){
    //         $user = new Comments;
    //         $rand = rand(1,1000);
    //         $user->content = 'Nội dung comment chưa update';
    //         $user->user_id = rand(1,1990); 

    //         if($rand%10<7){
    //             $user->image_id = rand(1,51794);
    //         } else{
    //             $user->posts_id = rand(1,15000);
    //         }
    //         if($rand%10==0){
    //             $user->reply_of_id = $reply_id;
    //         }
    //         $user->save();
    //         $reply_id = $user->id;
    //         // var_dump($user);
    //     }
    //     echo "string";
    // }

     $reply_id=0;
     for($i=0;$i<15000;$i++){
            $user = new MemberActions;
            $rand = rand(1,1000);
            $user->user_id = rand(1,1990); 

            if($rand%10<4){
                $user->type_action = 'upVote';
            } else if($rand%10<8){
                $user->type_action = 'downVote';
            } else {
                $user->type_action = 'share';
            }

            if($rand<50){
                $user->group_id = rand(1,500);
            } else if($rand<100){
                $user->service_id = rand(1,500);
            }else if($rand<400){
                $user->comment_id = rand(1,142655);
            }else if($rand<700){
                $user->posts_id = rand(1,1500);
            } else{
                $user->image_id = rand(1,51794);
            }


            $user->save();
            $reply_id = $user->id;
            // var_dump($user);
        }
        echo "string";
    }

}