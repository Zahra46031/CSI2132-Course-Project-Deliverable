import java.sql.*;

public class MainView {
    public static void main(String[] args) {
        try {
            Connection db = DriverManager.getConnection("", "postgres", "admin");
            Statement st = db.createStatement();

        } catch(SQLException e) {
            System.out.println("EXCEPTION: " + e.getMessage());
        }
    }
}
