package FanScouts;

public class FanData {
	private String name; //Analysts 
	private int score;  //Weekly Score
	private char grade; //Assigned Grade
	
	
	public int resetScore() { //reset the score
		return 0;
	}
	
	public double scoreAverage(int A, int B) {//average score between two analysts
		int average = (A + B)/2;
		return average;
	}
	
	public int pickBest(int A,  int B) {//user compares and picks best
		if (A > B) {
			return A;
		}else{
			return B;
		}
	}
	
	public int pickWorst(int A,  int B) {//user compare and picks worst
		if (A < B) {
			return A;
		}else{
			return B;
		}
	}
	
	public char giveHighestRank(int A) {//Assign S grade to analyst with score of 10
		if (A == 10) {
			return 'S';
		}else {
			return 'N';
		}
	}
	
	public char giveLowestRank(int A) {//Assign F Grade to analyst with scores of 0
		if (A == 0) {
			return 'F';
		}else {
			return 'N';
		}
	}
}
