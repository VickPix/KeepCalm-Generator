<?php
class KeepCalm {
	private $resPath;
	private $outPath;
	private $font;
	private $tmpImage;

	public function __construct($txt="write*something") {
        $this->resPath = __DIR__."/resources/";
        $this->outPath = "";//"output/";
        $this->font = $this->resPath."kc.ttf";
        $this->createImage($txt,'crown');
    }

	private function getResPath(){
		return $this->resPath;
	}

	private function getOutPath(){
		return $this->outPath;
	}

	private function getFont(){
		return $this->font;
	}

	private function getTmpImage(){
		return $this->tmpImage;
	}

	public function set($img){
		$this->tmpImage=$img;
	}

	public function show(){
		$im=$this->getTmpImage();
		header("Content-type: image/png");
		imagepng($im);
		imagedestroy($im); 
	}

	public function save($path=""){
		if($path=="")
			$path = $this->getOutPath();
		$name = $path.'keepcalm_'.time().'.png';
		$im=$this->getTmpImage();
		imagepng($im,$name);
		imagedestroy($im); 
	}

    public function createImage($txt,$symbol) {
        $width = 0;
		$height = 0;
		$maxfont = 45;
		$font = $this->getFont();
		$logoImg = $this->getResPath().$symbol.'.png';
		
		$txt=explode('*', 'keep*calm*and*'.$txt);
		$txt = array_map("strtoupper", $txt);
		$len = array_map('strlen', $txt);
		$index = array_search(max($len), $len);

		$box = @imageTTFBbox(30,0,$font,$txt[$index]);
		$width = abs($box[4] - $box[0])+200;
		$height = (abs($box[5] - $box[1])+30)*count($txt)+300;

		$im = imagecreatetruecolor($width,$height);
		$bgcolor = imagecolorallocate($im,rand(30,200), rand(30,200), rand(30,200));
		imagefilledrectangle($im, 0, 0, $width,$height, $bgcolor);

		$logo = imagecreatefrompng($logoImg);
		list($widthL, $heightL) = getimagesize($logoImg);
		imagecopyresampled($im, $logo, ($width/2 - 80), 20, 0, 0, 160, 160, $widthL, $heightL);
		$fontcolor = imagecolorallocate($im,255, 255, 255);
		$i=1;
		$x = $width/2;
		$y = 200;
		foreach ($txt as $t){
			$r=($i<3)? $maxfont : rand($maxfont-20,$maxfont-10);
			$rand_color=imagecolorallocate($im,rand(0,200), rand(0,200), rand(0,200));
			$box = @imageTTFBbox($r,0,$font,$t);
			$widthB = abs($box[4] - $box[0]);
			$heightB = abs($box[5] - $box[1]);
			$y+=$heightB+30;
			$xB = $x - $widthB/2;
			imagettftext($im, $r, 0, $xB, $y, $fontcolor, $font, $t);
			$i++;
		}
		
		$this->set($im);
    }
}
?>
